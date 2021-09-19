<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function shops()
    {
        return $this->hasMany('App\Shop','id');
    }
    public function addressBooks()
    {
        return $this->hasMany('App\AddressBook','id');
    }
}
