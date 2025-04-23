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

    protected $fillable = ['customer_id', 'total_price', 'order_date'];

    protected $dates = ['deleted_at'];

    protected function orderDate(): Attribute {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d H:i:s', $value)->format("d/m/Y H:i:s"),
            set: fn ($value) => Carbon::createFromFormat('d/m/Y H:i:s', $value)->format("Y-m-d H:i:s")
        );
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function payments(){
        return $this->HasMany(Payment::class, 'payment_id', 'id');
    }
    public function orderProducts(){
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

}
