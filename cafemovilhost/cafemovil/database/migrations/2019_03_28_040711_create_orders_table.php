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
            $table->decimal('total',13,4)->unsigned();
            $table->timestamps();
            $table->boolean('status');
            $table->timestamp('deliver_at');
            $table->timestamp('delivered_at')->nullable();
            
        });

        Schema::table('orders', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_client')->references('id')->on('students');
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
