<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function products()
    {
        return $this->hasMany('App\Product','shop_id');
    }
    public function editProducts()
    {
        return $this->hasMany('App\EditProduct','shop_id');
    }
    public function productsActive()
    {
        return $this->hasMany('App\Product','shop_id')->where('status','Active');
    }
    public function packages()
    {
        return $this->belongsTo('App\Package','package_id');
    }
    public function countries()
    {
        return $this->belongsTo('App\Country','country_id');
    }
    public function states()
    {
        return $this->belongsTo('App\State','state_id');
    }
    public function cities()
    {
        return $this->belongsTo('App\City','city_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
