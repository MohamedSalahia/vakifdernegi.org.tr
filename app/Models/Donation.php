<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Donation extends Model
{
    public const PENDING = 'pending';
    public const CONFIRMED = 'confirmed';
    public const CANCELLED = 'cancelled';

    protected $guarded = ['id'];

    protected $casts = [
        'amount' => 'decimal:2',
        'show_name' => 'boolean',
        'is_zakat' => 'boolean',
        'kvkk_accepted_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(DonationItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function confirmer()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    /** e.g. "Ahmet Yılmaz adına (vefat etmiş)" / "عن روح: أحمد" — null when not dedicated. */
    public function dedicationText(): ?string
    {
        if (!$this->dedication_type || !$this->dedication_name) {
            return null;
        }

        return __('site.dedication_' . $this->dedication_type . '_text', ['name' => $this->dedication_name]);
    }

    public function scopeConfirmed(Builder $query): Builder
    {
        return $query->where('status', self::CONFIRMED);
    }

    public function getRouteKeyName()
    {
        return 'reference';
    }

    public static function newReference(): string
    {
        do {
            // e.g. BAG-261126-7KQ2M — no ambiguous characters (0/O, 1/I)
            $ref = 'BAG-' . now()->format('ymd') . '-' . strtoupper(Str::of(Str::random(12))->replaceMatches('/[^A-HJ-NP-Z2-9]/i', '')->substr(0, 5));
        } while (strlen($ref) < 16 || static::where('reference', $ref)->exists());

        return $ref;
    }

    /** Total confirmed donations for a campaign (used for campaign progress). */
    public static function confirmedTotalForCampaign(int $campaignId): float
    {
        return (float) DonationItem::query()
            ->where('campaign_id', $campaignId)
            ->whereHas('donation', fn ($q) => $q->where('status', self::CONFIRMED))
            ->sum('amount');
    }
}
