<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // relation with Permissions
    public function permissionsGroup()
    {

        return $this->belongsTo('App\Permissions', 'permissions_id');
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'photo',
        'permissions_id',
        'status',
        'permissions',
        'connect_email',
        'connect_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shops()
    {
        return $this->hasMany('App\Shop','user_id');
    }

    public function shops_active()
    {
        return $this->hasMany('App\Shop','user_id')->where('status','Active');
    }

    public function products_active()
    {
        return $this->hasMany('App\Product','user_id')->where('status','Active');
    }
    public function favourites()
    {
        return $this->hasMany('App\Favourite','user_id');
    }
    public function carts()
    {
        return $this->hasMany('App\Cart','user_id');
    }
    public function addressBooks()
    {
        return $this->hasMany('App\AddressBook','user_id')->where('status','Active');
    }
    public function addressBooksDefault()
    {
        return $this->hasOne('App\AddressBook','user_id')->where('status','Default');
    }
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProducts','user_id');
    }
    public function wallets()
    {
        return $this->hasOne('App\Wallet','user_id');
    }
    public function reviews()
    {
        return $this->hasMany('App\Review','client_id');
    }
    public function editProducts()
    {
        return $this->hasMany('App\EditProduct','user_id');
    }
}
