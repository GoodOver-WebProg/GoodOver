<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();

            // seller id (foreign key)
            $table->unsignedBigInteger('seller_id');

            // food information
            $table->string('name');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('addon')->nullable();
            $table->text('description');
            $table->string('image_path')->nullable();

            // additional features
            $table->integer('pickup_time')->default(30);   // minutes
            $table->string('status')->default('available'); // available, reserved, taken

            $table->timestamps();

            // foreign key
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
