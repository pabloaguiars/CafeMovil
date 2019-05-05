<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //columns
            $table->bigIncrements('id');
            $table->bigInteger('id_client')->unsigned();
            $table->bigInteger('id_seller')->unsigned();
            $table->timestamps();
            $table->boolean('delivered');
            $table->timestamp('delivered_at')->nullable();
            
        });

        Schema::table('orders', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_client')->references('id')->on('students');
            $table->foreign('id_seller')->references('id')->on('sellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
