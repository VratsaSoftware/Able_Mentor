<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    /*
     * local scope current
     */
    public function scopeCurrent($query)
    {
        $query->whereDate('start', '<=', Carbon::now()->format('Y-m-d'))
            ->whereDate('end', '>=', Carbon::now()->format('Y-m-d'));
    }

    /*
     * local scope new
     */
    public function scopeNew($query)
    {
        $query->whereDate('start', '>', Carbon::now()->format('Y-m-d'))
            ->whereDate('end', '>', Carbon::now()->format('Y-m-d'));
    }

    /*
     * Season is current
     */
    public function isCurrent()
    {
        return Carbon::parse($this->start)->lt(Carbon::now()) && Carbon::parse($this->end)->addDays(1)->gt(Carbon::now());
    }

    /*
     * Season is new
     */
    public function isNew()
    {
        return Carbon::parse($this->start)->gt(Carbon::now()) && Carbon::parse($this->end)->addDays(1)->gt(Carbon::now());
    }
}