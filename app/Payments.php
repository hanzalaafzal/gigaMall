<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
   public function packages()
    {
        return $this->belongsTo('App\Package','package_id');
    }
}
