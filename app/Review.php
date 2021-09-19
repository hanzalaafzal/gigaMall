<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function products()
    {
        return $this->belongsTo('App\Product','id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','client_id');
    }
    public function orderProducts()
    {
        return $this->belongsTo('App\OrderProducts','order_product_id');
    }
}
