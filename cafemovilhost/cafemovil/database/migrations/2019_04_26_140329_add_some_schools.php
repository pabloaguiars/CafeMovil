<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class AddSomeSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 
        DB::table('schools')->insert(
            array(
                'name' => 'Instituto Tecnológico de Tijuana',
                'alias' => 'ITT',
                'campus' => 'Tomas Aquino',
                'address' =>  'Av Castillo de Chapultepec 562, Tomas Aquino, 22414 Tijuana, B.C.',
                'phone' => '6646078400',
                'email' => 'tomasaquino@tectijuana.com.mx',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );

        DB::table('schools')->insert(
            array(
                'name' => 'Universidad Autonoma de Baja California',
                'alias' => 'UABC',
                'campus' => 'Tijuana',
                'address' =>  'Universidad 14418, UABC, Parque Internacional Industrial Tijuana, 22427 Tijuana, B.C.',
                'phone' => '6649797500',
                'email' => 'tijuana@uabc.com.mx',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()                
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
