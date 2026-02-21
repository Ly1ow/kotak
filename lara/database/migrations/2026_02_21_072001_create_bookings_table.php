<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->integer('hours');
            $table->foreignId('skate_id')->nullable()->constrained()->nullOnDelete();
            $table->string('skate_model')->nullable();
            $table->integer('skate_size')->nullable();
            $table->boolean('has_own_skates')->default(false);
            $table->integer('total_amount');
            $table->boolean('is_paid')->default(false);
            $table->string('payment_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};