<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    public function categories()
    {
        return $this->belongsTo('App\Categories','parent_id');
    }
    public function products()
    {
        return $this->hasMany('App\Product','id');
    }
    public function editProducts()
    {
        return $this->hasMany('App\EditProduct','id');
    }
}
