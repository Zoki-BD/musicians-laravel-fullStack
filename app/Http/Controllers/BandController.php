<?php

namespace App\Http\Controllers;

use App\Http\Requests\BandRequest;
use App\Models\Band;
use App\Models\Genre;
use App\Models\Musician;
use App\Modules\Bands\BandServices;
use App\Modules\Cities\CityServices;
use App\Modules\Genres\GenreServices;
use App\Modules\Instruments\InstrumentServices;
use App\Modules\Musicians\MusicianServices;
use Illuminate\Support\Facades\Request;
use Intervention\Image\ImageManagerStatic as Image;
use stdClass;

//use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;

class BandController extends Controller
{

    public function index(BandServices $bandServices, CityServices $cityServices, InstrumentServices $instrumentServices)
    {
    //$musicians = Musician::all();
        $params = Request::all();
        $params_empty=array();
        $bands = $bandServices->getAllBands($params);
        $cities= $cityServices->getAllCities($params_empty);

        //dd($bands);
        return view('admin/bands/index', compact('bands','cities'));
    }

 

    //samo ovde se otvora a nema vo repository i service posto e get view
    public function create(BandServices $bandServices, CityServices $cityServices)
    {
        $params_empty=array();
        $bands = new StdClass();
        $cities = $cityServices->getAllCities($params_empty);
        //dd($cities);
        return view('admin/bands/edit', compact('bands', 'cities'));
    }

   



    //ova e post na create
    public function store(BandRequest $request, BandServices $bandServices, CityServices $cityServices )
    {
        $data=$request->all();
       // dd($data);

         //data-ta ne nosi pictures_name tuku samo file_source, zatoa dole ne mi e jasno kako ima $data['pictures']??????????

        /*create picture name ------------------------------------------------------------------------------------------*/
        $pictures_name = '';
        if (!empty($data['pictures'])) {
            $pictures_temp = $data['pictures']->getClientOriginalName();
            $pictures_name = date('Ymd_His') . '_' . $pictures_temp;
        }
        /*end create picture name ------------------------------------------------------------------------------------------*/

        //Tek sega otkako kreiravme gore pictures_name prop, odime da go povikame metodot koj bara 2 parametri ,data i slika

        $bands = $bandServices->storeBands( $data, $pictures_name);
        $id=$bands->id;
        //dd($bands);

        if ($bands && !empty($data['pictures'])) {
            /*create folder ------------------------------------------------------------------------------------------*/
            if (!file_exists(public_path('upload/bands/'.$id))) {
                mkdir(public_path('upload/bands/'.$id), 0777, true);
            }
            /*end create folder   ------------------------------------------------------------------------------------------*/

            $pictures=$data['pictures'];
            $width = Image::make($pictures)->width();
            $pictures = Image::make($pictures->getRealPath());
            if (($width > 800)) {
                $pictures->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $pictures->save(public_path('upload/bands/'.$id . '/' . $pictures_name), 100);
            // $pictures->move('upload/bands/'.$id,$pictures_name);
        }

     //ova e POST na toa za vo koi gradovi sviri bendot so ova ID kliknat na index.view
        // vikame vo prazniot array push-iraj gi ako vo poleto sme odbrale nekolku gradovi
        //VIP: znaci dole preku id="cities[]" od edit.view (kade e toa pokompliciranoto so PHP pisano) vikame ako ima
//
        $id_cities = array();

        //if (Request::has('cities')) moze i so ova globalnoto Request preku 'has'  metodot da se proveri dali e true cities
            if ($request->input('cities'))
            foreach($request->input('cities')as $id_city)
            {
                array_push($id_cities, $id_city);
            }

        $bands_cities = $cityServices->insertBandsCitiesById($id, $id_cities);
        //dd($id_cities);



        if($bands && $bands_cities ) {

            flash(__('auth.update_success'))->success();
            return redirect(url("bands/edit/{$id}" .'?'. $request->get('query')));
        }
        flash(__('auth.update_error'))->error();
        return redirect(url("bands/edit/{$id}" .'?'. $request->get('query')));
        
    }



 



    public function show($id, BandServices $bandServices, CItyServices $cityServices, MusicianServices $musicianServices, GenreServices $genreServices)
    {
        $bands = $bandServices->getBandsById($id);
        $empty_params = array();

        (isset($bands->id_cities)) ? ($city = ($cityServices->getCitiesById($bands->id_cities))->name) : $city =null;
        $bands_cities = $cityServices->getBandsCitiesById($id);
        $musicians = $musicianServices->getMusiciansByIdBands($id);
        $genres = $genreServices->getBandsGenresById($id);

        return view('admin/bands/show', compact('bands','city','musicians','bands_cities', 'genres' ));
        
    }




    //samo ovde se otvora a nema vo repository i service posto e get view
    public function edit($id, BandServices $bandServices, CityServices $cityServices, GenreServices $genreServices)
    {
        $genres = Genre::all();
       // dd($genres->);
        $params_empty=array();
        $bands = $bandServices->getBandsById($id);
        $cities= $cityServices->getAllCities($params_empty);
        $bands_cities = $cityServices->getBandsCitiesById($id);
        $genresAll = $genreServices->getAllGenres($params_empty);
        $genres = $genreServices->getBandsGenresById($id);
//        dd($bands_cities);

        return view('admin/bands/edit', compact('bands', 'cities','bands_cities', 'genres', 'genresAll'));
    }


 


    public function update($id, BandRequest $request, BandServices $bandServices, CityServices $cityServices, GenreServices $genreServices )
    {
//        $validated = $request->validated();
        $data = $request->all();
//      dd($validated);

        /*get old picture name ------------------------------------------------------------------------------------------*/
        $bands=$bandServices->getBandsById($id);
        $pictures_name_old='';
        if (!empty($bands['pictures'])) {$pictures_name_old = $bands['pictures'];}
        /*end get old picture name ------------------------------------------------------------------------------------------*/


        /*create picture name ------------------------------------------------------------------------------------------*/
        if (!empty($data['pictures'])) {
            $pictures_temp = $data['pictures']->getClientOriginalName();
            $pictures_name = date('Ymd_His') . '_' . $pictures_temp;
        } elseif (empty($data['file_source_1'])) {
            $pictures_name = '';
        } else {
            $pictures_name = $bands['pictures'];
        }
        /*end create picture name ------------------------------------------------------------------------------------------*/


        $bands = $bandServices->updateBands($id, $data, $pictures_name);

        if ($bands && !empty($data['pictures'])) {
            /*create folder ------------------------------------------------------------------------------------------*/
            if (!file_exists(public_path('upload/bands/'.$id))) {
                mkdir(public_path('upload/bands/'.$id), 0777, true);
            }
            /*end create folder   ------------------------------------------------------------------------------------------*/

            $pictures=$data['pictures'];
            $width = Image::make($pictures)->width();
            $pictures = Image::make($pictures->getRealPath());
            if (($width > 800)) {
                $pictures->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $pictures->save(public_path('upload/bands/'.$id . '/' . $pictures_name), 100);
            // $pictures->move('upload/bands/'.$id,$pictures_name);

            /*delete old file ------------------------------------------------------------------------------------------*/
            if (!empty($pictures_name_old)) {
                if (file_exists(public_path('upload/bands/' . $id . '/' . $pictures_name_old))) {
                    array_map('unlink', glob('upload/bands/' . $id . '/' . $pictures_name_old));
                }
            }
            /*end delete old file  ------------------------------------------------------------------------------------------*/
        }
        if ($bands && empty($data['file_source_1'])) {

            /*delete old file ------------------------------------------------------------------------------------------*/
            if (!empty($pictures_name_old)) {
                if (file_exists(public_path('upload/bands/' . $id . '/' . $pictures_name_old))) {
                    array_map('unlink', glob('upload/bands/' . $id . '/' . $pictures_name_old));
                }
            }
            /*end delete old file  ------------------------------------------------------------------------------------------*/
        }

        //ova e POST na toa za vo koi gradovi sviri bendot so ova ID kliknat na index.view
        // vikame vo prazniot array push-iraj gi ako vo poleto sme odbrale nekolku gradovi
        //VIP: znaci dole preku id="cities[]" od edit.view (kade e toa pokompliciranoto so PHP pisano) vikame ako ima
//
        $id_cities = array();

        //if (Request::has('cities')) moze i so ova globalnoto Request preku 'has'  metodot da se proveri dali e true cities
            if ($request->input('cities')) //ova se kliknatite gradovi vo dropdown vo blade so name="id_cities"
            foreach($request->input('cities')as $id_city)
            {
                array_push($id_cities, $id_city);
            }

        $bands_cities = $cityServices->insertBandsCitiesById($id, $id_cities);
        //dd($id_cities);



        if($bands && $bands_cities ) {

            flash(__('auth.update_success'))->success();
            return redirect(url("bands/edit/{$id}" .'?'. $request->get('query')));
        }
        flash(__('auth.update_error'))->error();
        return redirect(url("bands/edit/{$id}" .'?'. $request->get('query')));

    }

  



    public function destroy($id, BandServices $bandServices, Request $request,  MusicianServices $musicianServices)
    {
        //gi lovime site muzicari koi vo nivnoto pole id za bands go imaat ova id, i ako ima da ne ni dozvoli da briseme
        $musicians = $musicianServices->getMusiciansByIdBands($id);

        if(count($musicians) > 0) {
            flash(__('auth.delete_bands'))->error();
            return redirect(url("bands/" . '?'));
        }
        else {
            $bands = $bandServices->deletebands($id);
            // dd($bands);

            if ($bands) {
                flash(__('auth.delete_success'))->success();
                return redirect(url("bands/" . '?'));
            }
            flash(__('auth.delete_error'))->error();
            return redirect(url("bands/" . '?'));
        }


    }



}
