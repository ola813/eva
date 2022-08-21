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
        Schema::create('codegamings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('freefire110')->nullable();
            $table->string('freefire231')->nullable();;
            $table->string('freefire583')->nullable();;
            $table->string('pubge60')->nullable();;
            $table->string('pubge325')->nullable();;
            $table->string('Roblox10')->nullable();;
            $table->string('Razar5')->nullable();;
            $table->string('Razar10')->nullable();;
            $table->string('Razar20')->nullable();;
            $table->string('ituns5')->nullable();;
            $table->string('ituns10')->nullable();;
            $table->string('ituns20')->nullable();;
            $table->string('oropa200')->nullable();;
            $table->string('oropa315')->nullable();;
            $table->string('oropa795')->nullable();;
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
        Schema::dropIfExists('codegamings');
    }
};
