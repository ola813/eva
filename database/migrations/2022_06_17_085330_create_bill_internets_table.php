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
        Schema::create('bill_internets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('number');
            $table->integer('mobile_number');
            $table->string('companyInternet_id')->nullable();
            $table->string('full_name');
            $table->integer('price')->default(0);
            $table->integer('commission')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('messages')->nullable();
            $table->string('name_admin')->default('eyad');
            $table->string('type')->default('فاتورة الانترنت');
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
        Schema::dropIfExists('bill_internets');
    }
};
