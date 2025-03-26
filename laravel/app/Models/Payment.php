<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Payment extends Model
{
    //
    use HasFactory;

    protected $fillable = ['order_id', 'payment_method', 'amount','customer_id', 'payment_date'];


    protected function paymentDate(): Attribute {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format("'Y-m-d H:i:s'"),
            set: fn ($value) => Carbon::parse($value)
        );

    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
