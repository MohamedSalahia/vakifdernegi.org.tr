<?php

namespace App\Models\Concerns;

/** For models with "{field}_tr" + optional "{field}_ar" columns: Arabic when available on the Arabic site, else Turkish. */
trait HasLocalizedColumns
{
    public function localized(string $field): ?string
    {
        $ar = $this->getAttribute($field . '_ar');

        return (app()->getLocale() === 'ar' && filled($ar)) ? $ar : $this->getAttribute($field . '_tr');
    }
}
