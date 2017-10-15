<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSalesReturn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_return',function(Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_invoice_id')->unsigned();
            $table->integer('sales_order_product_id')->unsigned();
            $table->integer('qty_returned');
            $table->integer('qty_price_returned');
            $table->timestamps();
        });
        Schema::table('sales_return',function(Blueprint $table) {
            $table->foreign('sales_invoice_id')->references('id')->on('sales_invoice');
            $table->foreign('sales_order_product_id')->references('id')->on('sales_order_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales_return');
    }
}
