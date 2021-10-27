<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bands')->insert([
//            [
            ['name' => 'Кондор',
                'comment' => '',

                'id_cities' => '4',
                'sex' => 'M',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),

            ],
            ['name' => 'Архангел',
                'comment' => '',

                'id_cities' => '5',
                'sex' => 'M',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),

            ],
            ['name' => 'Нокаут',
                'comment' => '',

                'id_cities' => '19',
                'sex' => 'M',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),

            ],
        ]);
    }
}
