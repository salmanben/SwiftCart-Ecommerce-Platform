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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('banner');
            $table->string('shop_name')->unique();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->text('address');
            $table->text('description');
            $table->string('fb_link')->nullable();
            $table->string('tw_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
