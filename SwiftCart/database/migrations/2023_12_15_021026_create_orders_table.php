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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->unique();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->double('amount');
            $table->double('sub_total');
            $table->integer('count_products');
            $table->string('currency_icon');
            $table->text('order_address');
            $table->text('shipping_method');
            $table->string('payment_method');
            $table->text('coupon')->nullable();
            $table->string('order_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
