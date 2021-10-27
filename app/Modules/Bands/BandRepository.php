<?php

namespace App\Modules\Bands;

use App\Models\Band;

class BandRepository
{
    public function getAllBands($params)
    {

        $bands=Band::leftJoin('cities', 'cities.id', '=', 'bands.id_cities')
            ->where('bands.deleted', '=', '0')
            ->select(['bands.id',
                'bands.name',
                'bands.deactivated',
                'cities.id AS cities_id',
                'cities.name AS cities_name'])
        ;
        // dd($params['pageList']);

        if(isset($params['search1']) && !empty($params['search1'])) {
            $bands->where('bands.id', '=', $params['search1']);
        }
        if(isset($params['search2']) && !empty($params['search2'])) {
            $bands->where('bands.name', 'like', '%'.$params['search2'].'%');
        }
//        if(isset($params['search3']) && !empty($params['search3'])) {
//            $bands->where('federations.id', '=', $params['search3']);
//        }
        if(isset($params['search4']) && !empty($params['search4'])) {
            $bands->where('cities.id', '=', $params['search4']);
        }
//        if(isset($params['search5']) && !empty($params['search5'])) {
//            $bands->where('municipalities.id', '=', $params['search5']);
//        }

        $pageList = config('constants.pagination');
        if (isset($params['pageList']) && !empty($params['pageList'])) {
            $pageList = $params['pageList'];
            if ($params['pageList'] == 'a') {
                $pageList  =   $bands->count();
            }
        }
        if(!isset($params['sort']) && empty($params['sort'])&&!isset($params['order']) && empty($params['order'])) {
            $bands->orderBy('bands.id', 'DESC');
        }else{
            $bands->orderBy($params['order'], $params['sort'], "UTF-8");
        }
//        var_dump($bands->toSql());die();
       //dd($bands);

        return $bands->paginate($pageList);


    }

    public function getAllBandsSif()
    {
        $bands=Band::where('deleted', '=', '0')
            ->select(['id', 'name'])->orderBy('name', 'ASC')
            ->get();

        return $bands;
    }

    public function getBandsById($id)
    {
        if($id) {
            $bands = Band::where('id', '=', $id)->first();
            return $bands;
        }
        return null;
    }


    public function storeBands($data, $pictures_name)
    {
        date_default_timezone_set("Europe/Skopje");
        $date=date("Y-m-d H:i:s");
        if (isset($data['date_registration'])) {
            $date_registration = date('Y-m-d H:i:s', strtotime($data['date_registration']));
        } else {
            $date_registration= null;
        }

        if (isset($data['deactivated'])) {
            $deactivated = 0;
        }else{ $deactivated = 1;}

        //dd($deactivated);

        $id = Band::insertGetId([

            'name' => $data['name'],

            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],


            'id_cities' => $data['id_cities'],
            'sex' => $data['sex'],

            'comment' => $data['comment'],
            'pictures' => $pictures_name,
            'deactivated' => $deactivated,
            'created_at' => $date,
            'updated_at' =>$date
        ]);

        $bands = $this->getBandsById($id);
        return $bands;
    }

    public function updateBands($id, $data, $pictures_name)
    {
        $bands = $this->getBandsById($id);

        if ($bands) {

            date_default_timezone_set("Europe/Skopje");
            //dd($data['name']);
            $bands->name = $data['name'];

            $bands->address = $data['address'];
            $bands->phone = $data['phone'];
            $bands->email = $data['email'];

            $bands->comment = $data['comment'];
            $bands->pictures = $pictures_name;
            if (isset($data['deactivated'])) {
                $bands->deactivated = 0;
            } else {
                $bands->deactivated = 1;
            }

            $bands->id_cities = $data['id_cities'];
            $bands->sex = $data['sex'];

            // $bands->deleted = $data['deleted'];
            // $bands->created_at = $data['created_at'];
            $bands->updated_at = date("Y-m-d H:i:s");

            return $bands->save();
        }
        return null;
    }


    public function deleteBands($id )
    {
        $bands = $this->getBandsById($id);

        if($bands){
            $bands->deleted = 1;
            return $bands->save();
        }
        return null;
    }
}