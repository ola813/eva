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
        Schema::create('price_balances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orginal_price');
            $table->integer('commission')->default(0);
            $table->integer('price');
            $table->integer('valueaccount_id');
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
        Schema::dropIfExists('price_balances');
    }
};
