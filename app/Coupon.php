<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{protected $table = 'coupons';

    protected $fillable = [
        'id','promo_name', 'coupon_code', 'creation_date','expiry_date', 'coupon_status', 'discount_amount','discount_percentage','created_at','updated_at'
    ];   
    
    //
}
