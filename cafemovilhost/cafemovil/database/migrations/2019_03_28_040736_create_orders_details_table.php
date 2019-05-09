<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //columns
            $table->bigIncrements('id');
            $table->bigInteger('id_order')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_seller')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->decimal('import',13,4)->unsigned();
            $table->boolean('status')->unsigned();
            $table->index(['id', 'id_order','id_product']);
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });

        Schema::table('orders_details', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_order')->references('id')->on('orders');
            $table->foreign('id_product')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_details');
    }
}
