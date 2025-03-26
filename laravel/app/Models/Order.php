<?php

namespace App\Models;

use Dom\Attr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = ['customer_id', 'product_id', 'total_price', 'order_date'];

    protected $dates = ['deleted_at'];

    protected function orderDate(): Attribute {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format("'Y-m-d H:i:s'"),
            set: fn ($value) => Carbon::parse($value)
        );

    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function payment(){
        return $this->HasMony(Payment::class, 'payment_id', 'id');
    }
    public function orderProduct(){
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

}
