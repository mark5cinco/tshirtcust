<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCartsItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned();
            $table->integer('tshirt_id')->unsigned();
	        $table->integer('quantity')->unsigned()->default(1);
            $table->timestamps();

	        $table->foreign('cart_id')->references('id')->on('carts');
	        $table->foreign('tshirt_id')->references('id')->on('tshirts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cart_items');
    }
}
