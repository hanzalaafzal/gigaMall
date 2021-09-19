<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function shops()
    {
        return $this->hasMany('App\Shop','id');
    }
}
