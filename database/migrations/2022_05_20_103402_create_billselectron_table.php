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
        Schema::create('billselectron', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('counter_number');
            $table->integer('recorde_register');
            $table->integer('mobile_number');
            $table->integer('price')->nullable();
            $table->string('country');
            $table->string('type')->default('فاتورة الكهرباء');
            $table->tinyInteger('status')->default(0);
            $table->string('message')->nullable();
            $table->string('name_admin')->nullable();
            $table->integer('commission')->default(0);
            $table->integer('ordernum')->startingValue(5000);
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
        Schema::dropIfExists('billselectron');
    }
};
