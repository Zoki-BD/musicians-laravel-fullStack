<?php

namespace App\Http\Controllers;

use App\Http\Requests\MusicianRequest;
use App\Models\Musician;
use App\Modules\Bands\BandServices;
use App\Modules\Cities\CityServices;
use App\Modules\Genres\GenreServices;
use App\Modules\Instruments\InstrumentServices;
use App\Modules\Musicians\MusicianRepository;
use App\Modules\Musicians\MusicianServices;

use Illuminate\Support\Facades\Request;
//
//use Illuminate\Http\Request;
use Inertia\Inertia;
use Intervention\Image\ImageManagerStatic as Image; //ova bese za Image::  klasa kaj sportski
use stdClass;
use Illuminate\Support\Facades\DB;

//use Illuminate\Http\Request;



//use Illuminate\Routing\Controller;

class MusicianController extends Controller
{

   public function indexInertia(MusicianServices $musicianServices, BandServices $bandServices, InstrumentServices $instrumentServices)
   {

      $params = Request::all();
      $musiciansTest = Musician::all();

      $params_empty = array();
      $musicians = $musicianServices->getAllMusicians($params);
      $instruments = $instrumentServices->getAllInstruments($params_empty);
      $bands = $bandServices->getAllBandsSif();

      // dd(count($musicians));
      //dd($musicians);
      // dd(count($bands));
      //dd($musiciansTest->city->name);
      // dump($musiciansTest->city['name']);s


      return Inertia::render('Hello', [
         'musiciansTest' => $musiciansTest,
         'instruments' => $instruments,
         'bands' => $bands,
         'musicians' => $musicians
      ]);

      // return view('admin/musicians/index', compact('musicians', 'bands','instruments','musiciansTest'));
   }


   public function index(MusicianServices $musicianServices, BandServices $bandServices, InstrumentServices $instrumentServices)
   {

      $params = Request::all();

      //   Namerno e vaka povikan za da gi dade samo tie sto ne se pasivno deleted neli.
      //Ova moze i preku Musician klasata ama moze i preku DB vaka istoto. 

      $musiciansTest = DB::table('musicians')->where('deleted', '=', 0)->get();

      $params_empty = array();
      $musicians = $musicianServices->getAllMusicians($params);
      $instruments = $instrumentServices->getAllInstruments($params_empty);
      $bands = $bandServices->getAllBandsSif();

      // dd(count($musicians));
      //dd($musiciansTest);
      // dd(count($bands));
      //dd($musiciansTest->city->name);
      //dump($musiciansTest->city['name']);

      return view('admin/musicians/index', compact('musicians', 'bands', 'instruments', 'musiciansTest'));
   }

   //---------------------------------------------------------------------------------------------------
   public function indexApi(MusicianServices $musicianServices, BandServices $bandServices, InstrumentServices $instrumentServices)
   {

      $params = Request::all();

      $params_empty = array();
      $musicians = $musicianServices->getAllMusicians($params);
      $instruments = $instrumentServices->getAllInstruments($params_empty);
      $bands = $bandServices->getAllBandsSif();

      // $musiciansTest = Musician::all();

      //Ova moze i preku Musician klasata ama moze i preku DB vaka istoto. 

      $musiciansTest = DB::table('musicians')->where('deleted', '=', 0)->get();

      // dd(count($musicians));
      //dd($musicians);
      ////  dd(count($bands));
      //die();

      return  compact('musiciansTest', 'bands', 'musicians', 'instruments');

      // return view('admin/musicians/index', compact('musicians', 'bands','instruments'));
   }
   //---------------------------------------------------------------------------------------------------

   //______________________________________________________________________________________________________
   public function getMusiciansById($id)
   {
      if ($id) {
         $musicians = Musician::where('id', '=', $id)->first();
         return $musicians;
      }
      return null;
   }

   //Ova e apiID za da imame id vo react calendarot
   public function apiID($id)
   {
      if ($id) {
         $musician = Musician::where('id', '=', $id)->first();
         return $musician;
      }
      return null;
   }

   //CREATE_________________________________________________________________________________________________________________________________
   //Get za nov muzicar
   public function create(BandServices $bandServices, InstrumentServices $instrumentServices, CityServices $cityServices)
   {

      $params_empty = array();

      $musicians = new stdClass();
      //$documents = array();

      $instruments = $instrumentServices->getAllInstruments($params_empty);
      $cities = $cityServices->getAllCities($params_empty);
      $bands = $bandServices->getAllBandsSif();

      return view('admin/musicians/edit', compact('musicians', 'bands', 'instruments', 'cities'));
   }







   // STORE (post za create) _________________________________________________________________________________________________________________
   //Post na nov muzicar kreiran preku polinjata od Get gore t.e da se zacuva vo DB;
   public function store(MusicianServices $musicianServices, MusicianRequest $musicianRequest)
   {

      $data = $musicianRequest->all();
      //dd($data);

      /*create picture name ------------------------------------------------------------------------------------------*/
      $pictures_name = '';
      if (!empty($data['pictures'])) {
         $pictures_temp = $data['pictures']->getClientOriginalName();
         $pictures_name = date('Ymd_His') . '_' . $pictures_temp;
      }
      //dd($pictures_name);
      /*end create picture name ------------------------------------------------------------------------------------------*/
      $musicians = $musicianServices->storeMusicians($data, $pictures_name);
      $id = $musicians->id;
      //dd($id);
      if ($musicians && !empty($data['pictures'])) {
         /*create folder ------------------------------------------------------------------------------------------*/
         if (!file_exists(public_path('upload/musicians/' . $id))) {
            mkdir(public_path('upload/musicians/' . $id), 0777, true);
         }
         /*end create folder   ---------------------------------------------------------------------------------------*/
         $pictures = $data['pictures'];
         $width = Image::make($pictures)->width();
         $pictures = Image::make($pictures->getRealPath()); //Retrieving The Path To An Uploaded File
         if (($width > 800)) {
            $pictures->resize(800, null, function ($constraint) {
               $constraint->aspectRatio();
            });
         }
         $pictures->save(public_path('upload/musicians/' . $id . '/' . $pictures_name), 100);
      }
      if ($musicians) {
         flash(__('auth.new_success'))->success();
         return redirect(url("musicians/edit/{$id}" . '?' . $musicianRequest->get('query')));
      }
      flash(__('auth.new_error'))->error();
      return redirect(url("musicians/edit/{$id}" . '?' . $musicianRequest->get('query')));
   }


   public function show($id, MusicianServices $musicianServices, BandServices $bandServices, CityServices $cityServices, InstrumentServices $instrumentServices)
   {
      $musician = $musicianServices->getMusiciansById($id);

      (isset($musician->id_bands)) ? ($band = ($bandServices->getBandsById($musician->id_bands))->name) : $band = null;
      (isset($musician->id_cities)) ? ($city = ($cityServices->getCitiesById($musician->id_cities))->name) : $city = null;
      (isset($musician->id_instruments)) ? ($instrument = ($instrumentServices->getInstrumentsById($musician->id_instruments))->name) : $instrument = null;
      // dd($city);

      //       var_dump($band);

      return view('admin/musicians/show', compact('musician', 'band', 'instrument', 'city'));
   }

   // EDIT (get za update)________________________________________________________________________________________________________________________________

   public function edit($id, MusicianServices $musicianServices, BandServices $bandServices, InstrumentServices $instrumentServices, CityServices $cityServices)
   {

      $params_empty = array();
      $musicians = $musicianServices->getMusiciansById($id);
      (isset($musicians->id_instruments)) ? ($instrument = ($instrumentServices->getInstrumentsById($musicians->id_instruments))->name) : $instrument = null;
      (isset($musicians->id_cities)) ? ($city = ($cityServices->getCitiesById($musicians->id_cities))->name) : $city = null;

      if ($musicians->id_bands == 0) {
         $band = trans('properties.musicians.index.table_band_international');
      } elseif (isset($musicians->id_bands)) {
         $band = ($bandServices->getBandsById($musicians->id_bands))->name;
      } else {
         $band = null;
      }


      $instruments = $instrumentServices->getAllInstruments($params_empty);
      $cities = $cityServices->getAllCities($params_empty);
      $bands = $bandServices->getAllBandsSif();


      return view('admin/musicians/edit', compact('musicians', 'bands', 'cities', 'instruments', 'band')); //ova band e za kaj internacionalen
   }


   // UPDATE (post za update)_______________________________________________________________________________________________
   public function update($id, MusicianServices $musicianServices, MusicianRequest $musicianRequest)
   {
      //$validated = $musicianRequest->validated(); 
      $data = $musicianRequest->all();
      //dd($data); //

      /*get old picture name ------------------------------------------------------------------------------------------*/
      $musicians = $musicianServices->getMusiciansById($id);

      $pictures_name_old = '';
      if (!empty($musicians['pictures'])) {
         $pictures_name_old = $musicians['pictures'];
      }
      /*end get old picture name ------------------------------------------------------------------------------------------*/


      /*create picture name ------------------------------------------------------------------------------------------*/
      if (!empty($data['pictures'])) {
         $pictures_temp = $data['pictures']->getClientOriginalName();
         $pictures_name = date('Ymd_His') . '_' . $pictures_temp;
      } elseif (empty($data['file_source_1'])) {
         $pictures_name = '';
      } else {
         $pictures_name = $musicians['pictures'];
      }
      /*end create picture name ------------------------------------------------------------------------------------------*/


      $musicians = $musicianServices->updateMusicians($id, $data, $pictures_name);

      if ($musicians && !empty($data['pictures'])) {
         /*create folder ------------------------------------------------------------------------------------------*/
         if (!file_exists(public_path('upload/musicians/' . $id))) {
            mkdir(public_path('upload/musicians/' . $id), 0777, true);
         }
         /*end create folder   ------------------------------------------------------------------------------------------*/

         $pictures = $data['pictures'];
         $width = Image::make($pictures)->width();
         $pictures = Image::make($pictures->getRealPath());
         if (($width > 800)) {
            $pictures->resize(800, null, function ($constraint) {
               $constraint->aspectRatio();
            });
         }
         $pictures->save(public_path('upload/musicians/' . $id . '/' . $pictures_name), 100);

         /*delete old file ------------------------------------------------------------------------------------------*/
         if (!empty($pictures_name_old)) {
            if (file_exists(public_path('upload/musicians/' . $id . '/' . $pictures_name_old))) {
               array_map('unlink', glob('upload/musicians/' . $id . '/' . $pictures_name_old));
            }
         }
         /*end delete old file  ------------------------------------------------------------------------------------------*/
      }
      if ($musicians && empty($data['file_source_1'])) {

         /*delete old file ------------------------------------------------------------------------------------------*/
         if (!empty($pictures_name_old)) {
            if (file_exists(public_path('upload/musicians/' . $id . '/' . $pictures_name_old))) {
               array_map('unlink', glob('upload/musicians/' . $id . '/' . $pictures_name_old));
            }
         }
         /*end delete old file  ------------------------------------------------------------------------------------------*/
      }

      if ($musicians) {
         flash(__('auth.update_success'))->success();
         return redirect(url("musicians/edit/{$id}" . '?' . $musicianRequest->get('query')));
      }
      flash(__('auth.update_error'))->error();
      return redirect(url("musicians/edit/{$id}" . '?' . $musicianRequest->get('query')));
   }



   // DELETE_____________________________________________________________________________________________________________________

   public function destroy($id, MusicianServices $musicianServices)
   {
      //dd($id);
      $musicians = $musicianServices->deleteMusicians($id);
      // dd($musicians);

      if ($musicians) {
         flash(__('auth.delete_success'))->success();
         return redirect(url("musicians/" . '?'));
      }
      flash(__('auth.delete_error'))->error();
      return redirect(url("musicians/" . '?'));
   }
}
