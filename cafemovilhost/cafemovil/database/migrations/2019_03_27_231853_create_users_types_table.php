<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //columns
            $table->bigIncrements('id');
            $table->string('description')->nullable($value = false);
            $table->timestamps();
        });

        DB::table('users_types')->insert(
            array(
                'description' => 'Administrador de Escuela'
            )
        );
        DB::table('users_types')->insert(
            array(
                'description' => 'Vendedor'
            )
        );
        DB::table('users_types')->insert(
            array(
                'description' => 'Estudiante'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_types');
    }
}
