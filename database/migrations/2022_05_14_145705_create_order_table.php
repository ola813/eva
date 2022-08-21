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
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ordernum')->startingValue(5000);
            $table->string('user_id');
            $table->string('product_id');
            $table->string('product_qty');
            $table->string('code')->nullable();
            $table->string('count')->default(0);
            $table->double('couponAmount')->nullable();
            $table->string('user_name')->nullable();
            $table->string('number')->nullable();
            $table->string('unique')->nullable();
            $table->string('codegame')->nullable();
            $table->double('price');
            $table->double('price_point');
            $table->tinyInteger('status')->default(0);
            $table->string('message')->nullable();
            $table->string('name_admin')->default('eyad');
            $table->timestamps();
        });
        // DB::update("ALTER TABLE order AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};
