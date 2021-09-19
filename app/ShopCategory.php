<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    public function shops()
    {
        return $this->belongsTo('App\Shop','id');
    }
    public function categories()
    {
        return $this->belongsTo('App\Categories','category_id');
    }
}
