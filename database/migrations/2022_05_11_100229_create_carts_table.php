<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('total_id');
            $table->integer('product_id');
            $table->integer('product_price');
            $table->integer('total_price');
            $table->integer('product_qty');
            $table->string('user_name')->nullable();
            $table->string('number')->nullable();
            $table->string('unique')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
