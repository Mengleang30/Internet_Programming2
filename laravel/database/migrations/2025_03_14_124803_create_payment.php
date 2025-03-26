<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('payment_date')->useCurrent()->nullable(false);
            $table->string('payment_method',100)->nullable(false);
            $table->decimal('amount', 8, 2);
            $table->bigInteger('order_id')->unsigned()->nullable(false);
            $table->bigInteger('customer_id')->unsigned();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
