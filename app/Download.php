<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['name','filepath','price'];


        public function user()
    {

        return $this->belongsTo('App\User');
    }

    public function order()

    {

        return $this->belongsTo('App\Order');
    }



}
