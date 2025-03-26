<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'address', 'phone'];


    public function carts(){
        return $this->hasOne(Cart::class, 'customer_id', 'id');
    }
    public function order(){
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class, 'customer_id', 'id');
    }
    public function payment(){
        return $this->hasMany(Payment::class, 'customer_id', 'id');
    }
    public function products(){
        return $this->hasManyThrough(Product::class, Cart::class, 'customer_id', 'id', 'id', 'product_id');
    }

}
