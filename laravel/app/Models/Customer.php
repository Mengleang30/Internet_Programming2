<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use HasFactory ,SoftDeletes;
    protected $fillable = ['name', 'email', 'address', 'phone'];
    protected $dates = ['deleted_at'];


    public function carts(){
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }
    public function orders(){
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class, 'customer_id', 'id');
    }
    public function payments(){
        return $this->hasMany(Payment::class, 'customer_id', 'id');
    }
    public function products(){
        return $this->hasManyThrough(Product::class, Cart::class, 'customer_id', 'id', 'id', 'product_id');
    }

}
