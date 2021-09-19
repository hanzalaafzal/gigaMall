<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function payments()
    {
        return $this->hasMany('App\Payments','id');
    }
    public function shops()
    {
        return $this->hasMany('App\Shop','id');
    }
}
