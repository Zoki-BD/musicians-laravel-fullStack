<?php


namespace App\Modules\Genres;

use App\Models\Genre;
use Illuminate\Support\Facades\DB;


class GenreRepository
{
   public function getAllGenres($params)
   {
      $genres = Genre::orderBy('name', 'ASC')->get();
      return $genres;
   }


   public function getGenresById($id)
   {
      //dd($id);
      if ($id) {
         $genres = Genre::where('id', '=', $id)->first();
         return $genres;
      }
      return null;
   }



   public function getBandsGenresById($id)
   {
      $genres = Genre::where('genres.bands_id', '=', $id)->get();
      return $genres;
   }


   //___________________________________________________________________________________________________________________________________



   public function insertBandsGenresById($id_bands)
   {
      if ($id_bands) {
         date_default_timezone_set("Europe/Skopje");
         $date = date("Y-m-d H:i:s");
         // DB::table('genres')->where('id_bands',$id_bands)->delete();
         //foreach ($id_genres as $name)
         //                if (!DB::table('bands_citys')->where('id_bands', '=', $id_bands)->where('id_genres', '=', $id_city)->first()) {

         DB::table('genres')->insert([[
            'name' => 'kopuk',
            'bands_id' => $id_bands,
            'created_at' => $date,
            'updated_at' => $date,
         ],]);
      }

      //            var_dump($id_sport);
      //            dd($id_genres);

      return true;
   }
}
