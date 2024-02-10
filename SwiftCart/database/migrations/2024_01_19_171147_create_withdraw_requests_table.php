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
        Schema::create('withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->double('amount');
            $table->double('charge');
            $table->text('account_informations');
            $table->foreignId('vendor_id')->references('id')->on('vendors');
            $table->enum('status', ['pending', 'paid', 'decline'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('with_draw_requests');
    }
};
