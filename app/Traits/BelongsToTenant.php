<?php
/*
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant()
    {
        static::addGlobalScope('tenant_id', function (Builder $builder) {

            if (!function_exists('tenant') || !tenant()) {

                return $builder->where($builder->getModel()->getTable() . '.tenant_id', null);

            }

            $model = $builder->getModel();

            if ($model instanceof \App\Models\Role) {

                return $builder->where(function ($query) use ($builder) {
                    $query->where($builder->getModel()->getTable() . '.tenant_id', tenant()->id)
                        ->orWhereNull($builder->getModel()->getTable() . '.tenant_id');
                });

            } else {

                return $builder->where($builder->getModel()->getTable() . '.tenant_id', tenant()->id);

            }
        });

        static::creating(function ($model) {
            if (function_exists('tenant') && tenant()) {
                $model->tenant_id = tenant()->id;
            }
        });
    }

}// end of trait
*/
