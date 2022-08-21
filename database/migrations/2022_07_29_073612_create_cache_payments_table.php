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
        Schema::create('cache_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('account_number');
            $table->string('method_payment');
            $table->string('type')->default('syriatyl/MTN تحويل كاش ');
            $table->integer('Bill_price');
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
        Schema::dropIfExists('cache_payments');
    }
};
