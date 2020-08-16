<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function orderBook()
    {
        return $this->hasMany('App\OrderBook');
    }
}
