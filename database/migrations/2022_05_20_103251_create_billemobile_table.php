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
        Schema::create('billemobile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('Company');
            $table->integer('mobile_number');
            $table->integer('veryfiy_number');
            $table->integer('price');
            $table->integer('commission')->default(0);
            $table->string('type')->default('فاتورة الموبايل');
            $table->tinyInteger('status')->default(0);
            $table->string('message')->nullable();
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
        Schema::dropIfExists('billemobile');
    }
};
