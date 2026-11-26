<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** News/progress post shown in a campaign's "Updates" tab (Turkish + optional Arabic). */
class CampaignUpdate extends Model
{
    protected $guarded = ['id'];

    protected $casts = ['published_at' => 'date'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function getTitleAttribute(): string
    {
        return (app()->getLocale() === 'ar' && $this->title_ar) ? $this->title_ar : $this->title_tr;
    }

    public function getBodyAttribute(): string
    {
        return (app()->getLocale() === 'ar' && $this->body_ar) ? $this->body_ar : $this->body_tr;
    }
}
