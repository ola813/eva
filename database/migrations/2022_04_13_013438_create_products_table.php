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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('price_act')->default(0);
            $table->double('commission')->default(0);
            $table->double('orginal_price');
            $table->double('selling_price');
            $table->integer('point');
            $table->integer('price_point');
            $table->integer('type_product');
            $table->bigInteger('quantity')->default(1);
            $table->bigInteger('category_id');
            $table->string('photo');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('products');
    }

};
