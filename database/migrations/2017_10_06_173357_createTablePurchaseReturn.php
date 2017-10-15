<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePurchaseReturn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_return',function(Blueprint $table) {
            $table->increments('id');
            $table->integer('incoming_product_id')->unsigned();
            $table->integer('purchase_order_product_id')->unsigned();
            $table->integer('qty_returned');
            $table->integer('qty_price_returned');
            $table->timestamps();
        });
        Schema::table('purchase_return',function(Blueprint $table) {
            $table->foreign('incoming_product_id')->references('id')->on('incoming_product');
            $table->foreign('purchase_order_product_id')->references('id')->on('purchase_order_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('purchase_return');
    }
}
