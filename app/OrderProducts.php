<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    public function user()
    {
        return $this->hasMany('App\User','id');
    }
    public function products()
    {
        return $this->belongsTo('App\Product','product_id');
    }
    public function orders()
    {
        return $this->belongsTo('App\Order','order_id');
    }
    public function reviews()
    {
        return $this->hasOne('App\Review','order_product_id');
    }
    public function vendor()
    {
        return $this->belongsTo('App\User','vendor_id');
    }
    public function client()
    {
        return $this->belongsTo('App\User','client_id');
    }
}
