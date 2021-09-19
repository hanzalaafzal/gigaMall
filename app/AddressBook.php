<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','id');
    }
    public function usersDefault()
    {
        return $this->belongsTo('App\User','id');
    }
    public function countries()
    {
        return $this->belongsTo('App\Country','country_id');
    }
}
