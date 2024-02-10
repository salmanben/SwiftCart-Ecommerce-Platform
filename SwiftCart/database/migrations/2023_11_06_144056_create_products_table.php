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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->uniuqe();
            $table->string('image');
            $table->text('video_link')->nullable();
            $table->string('sku')->nullable();
            $table->integer('quantity');
            $table->text('short_description');
            $table->text('long_description');
            $table->double('price');
            $table->double('offer_price')->nullable();
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->integer('brand_id')->nullable();
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->integer('sub_category_id')->nullable();
            $table->integer('child_category_id')->nullable();
            $table->enum('product_type', ['New Arrival', 'Featured', 'Top Product', 'Best Product'])->nullable();
            $table->integer('is_approved')->default(0);
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
