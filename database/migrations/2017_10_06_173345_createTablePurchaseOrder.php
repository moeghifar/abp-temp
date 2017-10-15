<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePurchaseOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order', function(Blueprint $table){
            $table->increments('id');
            $table->date('date');
            $table->string('purchase_number');
            $table->integer('supplier_id')->unsigned();
            $table->integer('total_price');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('purchase_order_product', function(Blueprint $table){
            $table->increments('id');
            $table->integer('purchase_order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qty');
            $table->integer('qty_price');
            $table->timestamps();
        });
        Schema::table('purchase_order', function(Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
        Schema::table('purchase_order_product', function(Blueprint $table) {
            $table->foreign('purchase_order_id')->references('id')->on('purchase_order');
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
        Schema::drop('purchase_order_product');
        Schema::drop('purchase_order');
    }
}
