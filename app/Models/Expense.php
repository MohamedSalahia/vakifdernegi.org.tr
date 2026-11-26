<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedColumns;
use Illuminate\Database\Eloquent\Model;

/** Money spent by the association (shown on the transparency page when public). */
class Expense extends Model
{
    use HasLocalizedColumns;

    protected $guarded = ['id'];

    protected $casts = ['spent_at' => 'date', 'amount' => 'decimal:2', 'is_public' => 'boolean'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class)->withTrashed();
    }
}
