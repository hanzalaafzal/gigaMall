<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditProduct extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function shops()
    {
        return $this->belongsTo('App\Shop','shop_id');
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
}
