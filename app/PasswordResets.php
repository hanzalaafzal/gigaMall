<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table = 'password_resets';

    protected $fillable = [
        'email', 'token','created_at'
    ];
    public function setUpdatedAt($value)
    {
      return NULL;
    }
}
