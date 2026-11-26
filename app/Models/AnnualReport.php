<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedColumns;
use Illuminate\Database\Eloquent\Model;

class AnnualReport extends Model
{
    use HasLocalizedColumns;

    protected $guarded = ['id'];

    protected $casts = ['is_published' => 'boolean', 'year' => 'integer'];
}
