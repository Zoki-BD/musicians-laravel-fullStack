<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('musicians')->insert([
            [
                'name'=> 'Тони',
                'surname'=> 'Јовески',
                'sex'=> 'M',
                'id_instruments'=> 2,
                'id_cities'=> 10,
                'id_bands'=> 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=> 'Мирко',
                'surname'=> 'Дановски',
                'sex'=> 'M',
                'id_instruments'=> 7,
                'id_cities'=> 6,
                'id_bands'=> 3,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=> 'Јована',
                'surname'=> 'Диванова',
                'sex'=> 'F',
                'id_instruments'=> 2,
                'id_cities'=> 5,
                'id_bands'=> 5,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
        ]);
    }
}
