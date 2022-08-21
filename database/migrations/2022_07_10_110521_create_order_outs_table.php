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
        Schema::create('order_outs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('message');
            $table->double('price_act')->nullable();
            $table->double('price');
            $table->double('commission')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('notic')->nullable();
            $table->string('name_admin')->default('eyad');
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
        Schema::dropIfExists('order_outs');
    }
};
