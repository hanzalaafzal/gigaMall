<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{   
	protected $table = 'product_types';
    protected $fillable = ['name','slug'];

    public function products()
    {
        return $this->hasMany('App\Product','id');
    }
    public function editProducts()
    {
        return $this->hasMany('App\EditProduct','id');
    }

    public function categories()
    {
        return $this->hasMany('App\Categories','type_id');
    }
}
