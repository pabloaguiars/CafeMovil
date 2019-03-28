<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools_administrators', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //columns
            $table->bigIncrements('id');
            $table->string('id_at_school')->unique();
            $table->string('name')->nullable($value = false);
            $table->string('father_last_name')->nullable($value = false);
            $table->string('mother_last_name')->nullable($value = false);
            $table->string('curp')->unique()->nullable($value = false);
            $table->string('email')->unique()->nullable($value = false);
            $table->string('phone')->unique()->nullable($value = false);
            $table->timestamp('email_verified_at')->nullable($value = true);
            $table->boolean('status');
            $table->timestamps();
            $table->bigInteger('id_school')->unsigned();
        });

        Schema::table('schools_administrators', function (Blueprint $table) {
            //add foreign keys
            $table->foreign('id_school')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools_administrators');
    }
}
