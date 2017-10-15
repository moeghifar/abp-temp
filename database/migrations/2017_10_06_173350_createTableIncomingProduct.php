<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIncomingProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_product', function(Blueprint $table){
            $table->increments('id');
            $table->date('date');
            $table->string('invoice_number');
            $table->integer('purchase_order_id')->unsigned();
            $table->string('paid_status')->default(0);
            $table->string('return_status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('incoming_product', function(Blueprint $table) {
            $table->foreign('purchase_order_id')->references('id')->on('purchase_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('incoming_product');
    }
}
