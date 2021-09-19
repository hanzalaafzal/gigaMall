<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function shops()
    {
        return $this->hasMany('App\Shop','id');
    }
}
