<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $table = 'deals';

    protected $fillable = [
        'id', 'deal_name', 'creation_date','expiry_date', 'deal_status', 'discount_amount','discount_percentage','created_at','updated_at'
    ];
}
