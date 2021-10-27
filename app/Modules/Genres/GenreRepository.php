<?php


namespace App\Modules\Genres;

use App\Models\Genre;
use Illuminate\Support\Facades\DB;


class GenreRepository
{
    public function getAllGenres($params)
    {
        $genres=Genre::orderBy('name', 'ASC')->get();
        return $genres;

    }


    public function getGenresById($id)
    {
        //dd($id);
        if($id) {
            $genres = Genre::where('id', '=', $id)->first();
            return $genres;
        }
        return null;
    }


    //MOZE SAMO GET DA FUNKCIONIRA PREKU HASMANY i BELONGS TO. Za da ima
  //_____________________________________________________________________________________________________________________________________

    // ova e za da ni dade opcii za da imame pole vo edit i vo show kade ke bidat prikazani zanrovite na nekoj bend
    public function getBandsGenresById($id)
    {
             $genres = Genre::where('genres.bands_id', '=', $id )->get();
             return $genres;
    }


    //___________________________________________________________________________________________________________________________________


    //NE FUNKCIONIRA INSERTOT TREBA ZNACI POSEBNA TABELA AKO SAKAME DA IMAME I INSERT PREKU
    //ova e da moze vo edit da popolnime polinjata prethodno dobieni so get gore
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


    //______________________________________________________________________________________________________________________________________
//
//
//    public function storeCountries($data)
//    {
//
//        $countries = Countries::create([
//            'name' => $data['name'],
//            'created_at' => $data['created_at'],
//            'updated_at' => $data['updated_at']
//
//        ]);
//
//        return $countries;
//
//    }
//
//
//    public function updateCountries($id, $data)
//    {
//        $countries = $this->getCountriesById($id);
//
//        if($countries) {
//
//            $countries->name =$data['name'];
//            $countries->created_at = $data['created_at'];
//            $countries->updated_at = $data['updated_at'];
//
//            return $countries->save();
//        }
//        return null;
//    }
//
//
//    public function deleteCountries($id)
//    {
//        $countries = $this->getCountriesById($id);
//
//        if($countries) {
//           // $countries =Countries::where('id', '=', $id)->delete();
//            $countries->deleted = 1;
//            //dd($countries);
//            return $countries->save();
//        }
//        return null;
//
   // }
}
