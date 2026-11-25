<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationItem extends Model
{
    protected $guarded = ['id'];

    protected $casts = ['amount' => 'decimal:2'];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class)->withTrashed();
    }
}
