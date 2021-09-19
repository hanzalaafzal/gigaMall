<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function shops()
    {
        return $this->belongsTo('App\Shop','shop_id');
    }
    public function shopsActive()
    {
        return $this->belongsTo('App\Shop','shop_id')->where('status','Active');
    }
    public function galleries()
    {
        return $this->hasMany('App\ProductGallery','product_id');
    }
    public function categories()
    {
        return $this->belongsTo('App\Categories','category_id');
    }
    public function subCategories()
    {
        return $this->belongsTo('App\SubCategories','sub_category_id');
    }
    public function productTypes()
    {
        return $this->belongsTo('App\ProductType','product_type');
    }
    public function carts()
    {
        return $this->hasMany('App\Cart','id');
    }
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProducts','id');
    }
    public function reviews()
    {
        return $this->hasMany('App\Review','product_id');
    }
    public function favourites()
    {
        return $this->hasMany('App\Favourite','product_id');
    }
}
