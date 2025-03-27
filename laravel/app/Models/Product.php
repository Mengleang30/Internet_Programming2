<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    //
    protected $fillable = ['name', 'category_id','pricing','description','images'];

    protected $casts = [
        'images'=>'array',
    ];
    protected $dates = ['deleted_at'];

    public function category(){
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
