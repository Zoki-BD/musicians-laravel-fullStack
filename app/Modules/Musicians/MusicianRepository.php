<?php


namespace App\Modules\Musicians;


use App\Models\Musician;
use App\Modules\Bands\BandServices;
use App\Modules\Cities\GenreServices;
use App\Modules\Instruments\InstrumentServices;
use stdClass;

class MusicianRepository
{


   public  function getAllMusicians($params)
   {

      $musicians = Musician::leftJoin('bands', 'bands.id', '=', 'musicians.id_bands')
         ->leftJoin('instruments', 'instruments.id', '=', 'musicians.id_instruments')
         ->where('musicians.deleted', '=', 0)
         ->select([
            'musicians.id',
            'musicians.name',
            'musicians.surname',
            'musicians.sex',
            'musicians.id_bands',
            'musicians.deactivated',
            'bands.id AS bands_id',
            'bands.name AS bands_name',
            'instruments.id AS instruments_id',
            'instruments.name AS instruments_name'
         ]);
      //var_dump($musicians->toSql());die();
      // dd($musicians->toSql());


      if (isset($params['search1']) && !empty($params['search1'])) {
         $musicians->where('musicians.id', '=', $params['search1']);
      }
      if (isset($params['search2']) && !empty($params['search2'])) {
         $musicians->where('musicians.name', 'like', '%' . $params['search2'] . '%');
      }
      if (isset($params['search3']) && !empty($params['search3'])) {
         $musicians->where('musicians.surname', 'like', '%' . $params['search3'] . '%');
      }
      if (isset($params['search4']) && !empty($params['search4'])) {
         $musicians->where('musicians.sex', 'like', '%' . $params['search4'] . '%');
      }
      if (isset($params['search5'])) {
         if ($params['search5'] != '') {
            // dd($params);
            $musicians->where('musicians.id_bands', '=', $params['search5']);
         }
      }
      if (isset($params['search6']) && !empty($params['search6'])) {
         $musicians->where('instruments.id', '=', $params['search6']);
      }

      $pageList = config('constants.pagination');
      if (isset($params['pageList']) && !empty($params['pageList'])) {
         $pageList = $params['pageList'];
         if ($params['pageList'] == 'a') {
            $pageList  =   $musicians->count();
         }
      }
      if (!isset($params['sort']) && empty($params['sort']) && !isset($params['order']) && empty($params['order'])) {
         $musicians->orderBy('musicians.id', 'DESC');
      } else {
         $musicians->orderBy($params['order'], $params['sort'], "UTF-8");
      }

      //dd(count($musicians));
      return $musicians->paginate($pageList);
   }


   //________________________________________________________________________________________________
   public function getMusiciansById($id)
   {
      if ($id) {
         $musicians = Musician::where('id', '=', $id)->first();
         return $musicians;
      }
      return null;
   }


   //________________________________________________________________________________________________
   public  function getMusiciansByIdBands($id)
   {
      if ($id) {
         $musicians = Musician::where('musicians.id_bands', '=', $id)
            ->where('musicians.deleted', '=', '0')
            ->select([
               'musicians.id',
               'musicians.name',
               'musicians.surname',
            ])
            ->get();
         return $musicians;
      }
      return null;
   }

   //________________________________________________________________________________________________
   public function storeMusicians($data, $pictures_name)
   {
      date_default_timezone_set("Europe/Skopje");
      $date = date("Y-m-d H:i:s");
      if (isset($data['date_birth'])) {
         $date_birth = date('Y-m-d H:i:s', strtotime($data['date_birth']));
      } else {
         $date_birth = null;
      }

      if (isset($data['deactivated'])) {
         $deactivated = 0;
      } else {
         $deactivated = 1;
      }


      $id = Musician::insertGetId([

         'name' => $data['name'],
         'surname' => $data['surname'],
         'date_birth' => $date_birth,
         'email' => $data['email'],
         'id_cities' => $data['id_cities'],

         'id_bands' => $data['id_bands'],
         //            'id_category_age' => $data['id_category_age'],
         'id_instruments' => $data['id_instruments'],
         'sex' => $data['sex'],
         //            'club_international' => $data['club_international'],


         'comment' => $data['comment'],
         'pictures' => $pictures_name,
         'deactivated' => $deactivated,
         'created_at' => $date,
         'updated_at' => $date

      ]);
      $musicians = $this->getMusiciansById($id);
      return $musicians;
   }

   //________________________________________________________________________________________________
   public function updateMusicians($id, $data, $pictures_name)
   {
      $musicians = $this->getMusiciansById($id);

      if ($musicians) {

         date_default_timezone_set("Europe/Skopje");
         //dd($data['name']);

         if (isset($data['date_birth'])) {
            $musicians->date_birth = date('Y-m-d H:i:s', strtotime($data['date_birth']));
         } else {
            $musicians->date_birth = null;
         }

         $musicians->name = $data['name'];
         $musicians->surname = $data['surname'];
         $musicians->email = $data['email'];

         $musicians->id_cities = $data['id_cities'];
         $musicians->id_instruments = $data['id_instruments'];
         $musicians->id_bands = $data['id_bands'];

         $musicians->sex = $data['sex'];

         $musicians->comment = $data['comment'];
         $musicians->pictures = $pictures_name;
         if (isset($data['deactivated'])) {
            $musicians->deactivated = 0;
         } else {
            $musicians->deactivated = 1;
         }

         //            $musicians->deleted = $data['deleted'];
         //            $musicians->created_at = $data['created_at'];
         $musicians->updated_at = date("Y-m-d H:i:s");

         return $musicians->save();
      }
      return null;
   }

   //_________________________________________________________________________________________________________
   public function deleteMusicians($id)
   {
      $musicians = $this->getMusiciansById($id);

      if ($musicians) {
         // $musicians =Musicians::where('id', '=', $id)->delete();
         $musicians->deleted = 1;
         //dd($musicians);
         return $musicians->save();
      }
      return null;
   }
}
