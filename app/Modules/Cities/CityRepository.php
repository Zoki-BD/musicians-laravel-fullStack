<?php


namespace App\Modules\Cities;

use App\Models\City;
use Illuminate\Support\Facades\DB;


class CityRepository
{
   public function getAllCities($params)
   {
      $cities = City::orderBy('name', 'ASC')->get();
      return $cities;
   }


   public function getCitiesById($id)
   {
      //dd($id);
      if ($id) {
         $cities = City::where('id', '=', $id)->first();
         return $cities;
      }
      return null;
   }

   //_____________________________________________________________________________________________________________________________________

   // ova e za da ni dade opcii za da imame pole vo edit i vo show kade ke bidat prikazani gradovite kade nastapuva nekoj bend
   public function getBandsCitiesById($id)
   {
      if ($id) {
         $bands_cities = DB::table('bands_cities')
            ->leftJoin('bands', 'bands.id', '=', 'bands_cities.id_bands')
            ->leftJoin('cities', 'cities.id', '=', 'bands_cities.id_cities')
            ->select([
               'bands_cities.id',
               'bands_cities.id_bands',
               'cities.name',
               'bands_cities.id_cities'
            ])
            ->where('bands_cities.id_bands', '=', $id)
            //                ->orderby('bands_cities','DESC') //dava SQL error za kolona
            ->get();

         return $bands_cities;
      }
      return null;
   }
   //___________________________________________________________________________________________________________________________________

   //ova e da moze vo edit da popolnime polinjata prethodno dobieni so get gore
   public function insertBandsCitiesById($id_bands, $id_cities)
   {
      if ($id_bands) {
         date_default_timezone_set("Europe/Skopje");
         $date = date("Y-m-d H:i:s");

         DB::table('bands_cities')->where('id_bands', $id_bands)->delete();

         foreach ($id_cities as $id_city) {
            //                if (!DB::table('bands_citys')->where('id_bands', '=', $id_bands)->where('id_cities', '=', $id_city)->first()) {

            DB::table('bands_cities')->insert([[
               'id_bands' => $id_bands,
               'id_cities' => $id_city,
               'created_at' => $date,
               'updated_at' => $date,
            ],]);
            //                }

         }

         return true;
      }
      return null;
   }
}
