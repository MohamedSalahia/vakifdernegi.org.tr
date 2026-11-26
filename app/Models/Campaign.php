<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['name', 'description', 'name_slug',
        'meta_title','meta_description','keywords','image_alt', 'country'
    ];
    protected $guarded = [];

    protected $casts = [
        'show_in_slider' => 'boolean',
        'is_urgent' => 'boolean',
        'accepts_zakat' => 'boolean',
        'show_donors' => 'boolean',
        'share_count' => 'integer',
    ];

    /** Memoised confirmed totals (one query per campaign per request). */
    private ?array $stats = null;

    public function updates()
    {
        return $this->hasMany(CampaignUpdate::class)->orderByDesc('published_at')->orderByDesc('id');
    }

    public function donationItems()
    {
        return $this->hasMany(DonationItem::class);
    }

    /** Confirmed donation items for this campaign, newest first (for the public donors tab). */
    public function confirmedDonationItems()
    {
        return $this->donationItems()
            ->whereHas('donation', fn ($q) => $q->where('status', Donation::CONFIRMED))
            ->with('donation')
            ->latest('id');
    }

    public function stats(): array
    {
        if ($this->stats === null) {
            $row = DonationItem::query()
                ->where('campaign_id', $this->id)
                ->whereHas('donation', fn ($q) => $q->where('status', Donation::CONFIRMED))
                ->selectRaw('COALESCE(SUM(amount), 0) as raised, COUNT(DISTINCT donation_id) as donors')
                ->first();
            $raised = (float) $row->raised;
            $goal = (float) $this->goal;
            $this->stats = [
                'raised' => $raised,
                'donors' => (int) $row->donors,
                'goal' => $goal,
                'remaining' => max(0, $goal - $raised),
                'percent' => $goal > 0 ? (int) min(100, round($raised / $goal * 100)) : 0,
            ];
        }

        return $this->stats;
    }

    public function isOpenForDonations(): bool
    {
        return !$this->trashed() && $this->status === 'active' && $this->complete !== 'yes';
    }

    public function category()
    {
        return $this->belongsTo(CampaignCategory::class, 'c_category_id');
    }

    public function userDonation()
    {
        return $this->hasMany(UserDonation::class);
    }

    public function campaignUsers()
    {
        return $this->hasOneThrough(User::class, UserDonation::class, 'user_id', 'id');
    }

}
