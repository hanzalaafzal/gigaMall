<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function products()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
