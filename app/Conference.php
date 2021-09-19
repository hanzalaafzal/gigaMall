<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $table = 'conference';

    protected $fillable = ['id','owner_user_id','room_number','chat_id','created_at','updated_at'];   
  
}
