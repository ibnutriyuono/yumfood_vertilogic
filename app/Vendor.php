<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
    public function dishes()
    {
        return $this->hasMany('App\Dish');
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
