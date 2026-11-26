<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedColumns;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasLocalizedColumns;

    public const CATEGORIES = ['donation', 'payment', 'zakat', 'general'];

    protected $guarded = ['id'];

    protected $casts = ['is_active' => 'boolean', 'sort_order' => 'integer'];
}
