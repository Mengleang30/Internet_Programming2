<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //
    protected $fillable = ['name', 'category_id','pricing','description','images'];

    protected $casts = [
        'images'=>'array',
    ];

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class, 'product_id', 'id');
    }
    public function carts(){
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }
    public function wishlists(){
        return $this->hasMany(Wishlist::class, 'product_id', 'id');
    }
    
}
