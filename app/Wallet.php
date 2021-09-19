<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{ 
    protected $table = 'wallets';

    protected $fillable = [
        'id','user_id','amount','referral_bonus','status','created_at','updated_at'];   
 
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function client()
    {
        return $this->belongsTo('App\User','client_id');
    }
}
