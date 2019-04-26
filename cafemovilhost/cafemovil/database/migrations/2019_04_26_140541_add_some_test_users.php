<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class AddSomeTestUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('students')->insert(
            array(
                'id_at_school' => '16211958',
                'name' => 'Pablo',
                'father_last_name' => 'Aguiar',
                'mother_last_name' => 'Solis',
                'curp' => 'AUSP980730HBCGLB00',
                'email' => 'paguiar_student@uwu.com',
                'phone' => '6644437802',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'id_school' => 1
            )
        );

        DB::table('users')->insert(
            array(
                'email' => 'paguiar_student@uwu.com',
                'password' => Hash::make('password'),
                'status' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'id_user_type' => 3
            )
        );

        DB::table('sellers')->insert(
            array(
                'id_at_school' => '16211958',
                'name' => 'Pablo',
                'father_last_name' => 'Aguiar',
                'mother_last_name' => 'Solis',
                'curp' => 'AUSP980730HBCGLB00',
                'email' => 'paguiar_seller@uwu.com',
                'phone' => '6644437802',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'id_school' => 1
            )
        );

        DB::table('users')->insert(
            array(
                'email' => 'paguiar_seller@uwu.com',
                'password' => Hash::make('password'),
                'status' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'id_user_type' => 2
            )
        );

        DB::table('schools_administrators')->insert(
            array(
                'id_at_school' => '1958',
                'name' => 'Pablo',
                'father_last_name' => 'Aguiar',
                'mother_last_name' => 'Solis',
                'curp' => 'AUSP980730HBCGLB00',
                'email' => 'paguiar_school_administrator@uwu.com',
                'phone' => '6644437802',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'id_school' => 1
            )
        );

        DB::table('users')->insert(
            array(
                'email' => 'paguiar_school_administrator@uwu.com',
                'password' => Hash::make('password'),
                'status' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'id_user_type' => 1
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
        //
    }
}
