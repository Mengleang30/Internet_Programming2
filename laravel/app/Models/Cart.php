<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    //
    protected $fillable = ['customer_id', 'product_id', 'quantity'];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


}
