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

    /**
     * The scope for fetching all future events
     * 
     * @param  Illuminate\Database\Eloquent\Builder $query
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scopeFuture(Builder $query)
    {
        return $query
            ->join('workshops', function ($join) {
                $join->on('events.id', '=', 'workshops.event_id');
            })
            ->select('events.*')
            ->havingRaw('MIN(workshops.start) > ?', [Carbon::now()])
            ->groupBy('events.id');   
    }

    /**
     * Fetch all the future events with workshops.
     * 
     * @param  Illuminate\Database\Eloquent\Builder $query
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scopeFutureWithWorkshops(Builder $query)
    {
        return $query
            ->future()
            ->withWorkshops();
    }
}

