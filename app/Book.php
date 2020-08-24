<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function orderBooks()
    {
        return $this->hasMany('App\OrderBook');
    }
}
