<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = ['order_id', 'payment_method', 'amount','customer_id', 'payment_date'];

    protected $dates = ['deleted_at'];

    protected function paymentDate(): Attribute {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d H:i:s', $value)->format("d/m/Y H:i:s"),
            set: fn ($value) => Carbon::createFromFormat('d/m/Y H:i:s', $value)->format("Y-m-d H:i:s")
        );
    }

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
