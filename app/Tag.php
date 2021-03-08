<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    
    public function vendors()
    {
        return $this->morphedByMany('App\Vendor', 'taggable');
    }
}
