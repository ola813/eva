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
        Schema::create('blance_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('value');
            $table->integer('mobile_number');
            $table->integer('price');
            $table->tinyInteger('status')->default(0);
            $table->string('message')->nullable();
            $table->string('type')->default('تحويل الرصيد');
            $table->string('name_admin')->default('eyad');
            $table->integer('user_id');
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
        Schema::dropIfExists('blance_transfers');
    }
};
