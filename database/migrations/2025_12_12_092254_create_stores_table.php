<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();

            // Relasi ke users (seller)
            $table->unsignedBigInteger('user_id');

            // Dari ERD kamu
            $table->string('name');             // Nama toko
            $table->text('address')->nullable();
            $table->string('contact', 255)->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->text('image_path')->nullable();

            $table->timestamps();

            // Foreign key ke table users
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
