<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProducts','order_id');
    }
    public function orderAddressesShipping()
    {
        return $this->hasOne('App\OrderAddress','order_id')->where('type','Shipping');
    }
    public function orderAddressesBilling()
    {
        return $this->hasOne('App\OrderAddress','order_id')->where('type','Billing');
    }
}
