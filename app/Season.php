<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    /*
     * Season is current
     */
    public function isCurrent()
    {
        return \Carbon\Carbon::parse($this->start)->lt(\Carbon\Carbon::now()) && \Carbon\Carbon::parse($this->end)->addDays(1)->gt(\Carbon\Carbon::now());
    }

    /*
     * Season is new
     */
    public function isNew()
    {
        return \Carbon\Carbon::parse($this->start)->gt(\Carbon\Carbon::now()) && \Carbon\Carbon::parse($this->end)->addDays(1)->gt(\Carbon\Carbon::now());
    }
}
