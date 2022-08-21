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
        Schema::create('firstpayments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('type')->nullable();
            $table->double('account');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('firstpayments');
    }
};
