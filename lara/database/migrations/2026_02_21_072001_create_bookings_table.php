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
            
            // Индексы для оптимизации
            $table->index('skate_id');
            $table->index('phone');
            $table->index('created_at');
        });

        // Добавляем внешний ключ, если таблица skates уже существует
        if (Schema::hasTable('skates')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreign('skate_id')
                      ->references('id')
                      ->on('skates')
                      ->onDelete('set null');
            });
        }
    }

    public function down()
    {
        // Сначала удаляем внешний ключ, если он существует
        if (Schema::hasTable('bookings')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropForeign(['skate_id']);
            });
        }
        
        Schema::dropIfExists('bookings');
    }
};