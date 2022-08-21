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
        Schema::create('bille_phone', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('number');
            $table->integer('mobile_number');
            $table->string('type')->default('فاتورة الهاتف الارضي');
            $table->integer('price')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('messages')->nullable();
            $table->string('name_admin')->default('eyad');
            $table->integer('commission')->default(0);
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
        Schema::dropIfExists('bille_phone');
    }
};
