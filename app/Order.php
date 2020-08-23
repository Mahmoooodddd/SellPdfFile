<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function orderBooks()
    {
        return $this->hasMany('App\OrderBook');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
}
