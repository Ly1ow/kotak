<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->unsignedBigInteger('skate_id')->nullable();
            $table->string('skate_model')->nullable();
            $table->integer('skate_size')->nullable();
            $table->boolean('has_own_skates')->default(false);
            $table->integer('total_amount');
            $table->boolean('is_paid')->default(false);
            $table->string('payment_id')->nullable();
            $table->timestamps();
        });

        // Добавляем внешний ключ после создания таблицы
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign('skate_id')
                  ->references('id')
                  ->on('skates')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        // Сначала удаляем внешний ключ, потом таблицу
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['skate_id']);
        });
        
        Schema::dropIfExists('bookings');
    }
};