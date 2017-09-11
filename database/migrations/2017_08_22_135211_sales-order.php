<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SalesOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order', function(Blueprint $table){
            $table->increments('id');
            $table->date('date');
            $table->string('sales_number');
            $table->integer('customer_id')->unsigned();
            $table->integer('total_price');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('sales_order_product', function(Blueprint $table){
            $table->increments('id');
            $table->integer('sales_order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qty');
            $table->integer('qty_price');
            $table->timestamps();
        });
        Schema::table('sales_order', function(Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
        });
        Schema::table('sales_order_product', function(Blueprint $table) {
            $table->foreign('sales_order_id')->references('id')->on('sales_order');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_order_product');
        Schema::dropIfExists('sales_order');
    }
}
