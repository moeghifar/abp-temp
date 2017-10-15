<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSalesInovice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice', function(Blueprint $table){
            $table->increments('id');
            $table->date('date');
            $table->string('invoice_number');
            $table->integer('sales_order_id')->unsigned();
            $table->string('paid_status')->default(0);
            $table->string('return_status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('sales_invoice', function(Blueprint $table) {
            $table->foreign('sales_order_id')->references('id')->on('sales_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales_invoice');
    }
}
