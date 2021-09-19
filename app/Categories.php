<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function subCategories()
    {
        return $this->hasMany('App\SubCategories','id');
    }
    public function products()
    {
        return $this->hasMany('App\Product','id');
    }
    public function Editproducts()
    {
        return $this->hasMany('App\EditProduct','id');
    }
    public function shopCategories()
    {
        return $this->hasMany('App\ShopCategory','id');
    }

    public function types()
    {
        return $this->belongsTo('App\ProductType','type_id');
    }
}
