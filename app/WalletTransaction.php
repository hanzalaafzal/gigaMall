<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $table = 'wallet_transactions';

    protected $fillable = [
        'id','transaction_type','transaction_amount','transaction_date','user_id','transaction_head','created_at','updated_at'];   
}
