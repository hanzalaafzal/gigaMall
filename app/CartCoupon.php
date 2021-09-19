<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartCoupon extends Model
{
    protected $table = 'cart_coupons';

    protected $fillable = [
        'id','coupon_id', 'user_id','created_at','updated_at'
    ];
}
