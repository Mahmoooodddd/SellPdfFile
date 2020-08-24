<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderBook extends Model
{
    public function order()
    {
       return $this->belongsTo('App\Order');
    }
    public function book()
    {
        return $this->belongsTo('App\Book');

    }
}
