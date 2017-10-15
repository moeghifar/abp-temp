<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_of_accounts', function(Blueprint $table){
            $table->increments('id');
            $table->integer('number_of_accounts');
            $table->string('name_of_accounts');
            $table->string('debit');
            $table->string('credit');
            $table->string('balance');
            $table->string('grouping');
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
        Schema::drop('cart_of_accounts');
    }
}
