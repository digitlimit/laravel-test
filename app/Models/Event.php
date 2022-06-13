<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Event extends Model
{
    /**
     * Fetches all events for an event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workshops()
    {
        return $this->hasMany(Workshop::class);
    }

    /**
     * The scope for fetching all events for an event.
     * We defined scope for fluency and maintainability.
     * 
     * @param  Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scopeWithWorkshops(Builder $query)
    {
        return $query->with('workshops');
    }

}

