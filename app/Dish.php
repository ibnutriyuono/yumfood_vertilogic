<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    //
    public function vendor() 
    {
        return $this->belongsTo('App\Vendor');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
