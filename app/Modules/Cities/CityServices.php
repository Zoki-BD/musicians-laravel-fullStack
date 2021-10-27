<?php


namespace App\Modules\Cities;





class CityServices
{

    private $cityRepository;


    public function __construct(cityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function getAllCities($params)
    {
        $cities = $this->cityRepository->getAllCities($params);
        return $cities;
    }

    public function getCitiesById($id)
    {
        if($id) {
            $cities = $this->cityRepository->getCitiesById($id);
            return $cities;
        }
        return null;
    }

// ova e za da ni dade opcii za da imame pole vo edit i vo show kad eke bidat prikazani gradovite kade nastapuva nekoj bend
    public function getBandsCitiesById($id) {

        if($id) {
            $bands_cities = $this->cityRepository->getBandsCitiesById($id);
            return $bands_cities;
        }
        return null;
    }

    //ova e da moze vo edit da popolnime polinjata prethodno dobieni so get gore
    public function insertBandsCitiesById($id_bands, $id_cities) {

        if($id_bands) {
            $bands_cities = $this->cityRepository->insertBandsCitiesById($id_bands, $id_cities);
            return $bands_cities;
        }
        return null;
    }


//
//    public function storeCitiess($data)
//    {
//        if($data) {
//            $Citiess =  $this->countriesRepository->storeCitiess($data);
//            return $Citiess;
//        }
//        return null;
//    }
//
//    public function updateCitiess($id, $data)
//    {
//        if($id && $data) {
//            $Citiess =  $this->countriesRepository->updateCitiess($id, $data);
//            return $Citiess;
//        }
//        return null;
//    }
//
//    public function deleteCitiess($id)
//    {
//        $Citiess = $this->countriesRepository->getCitiessById($id);
//
//        if($Citiess) {
//            $Citiess = $this->countriesRepository->deleteCitiess($id);
//            return $Citiess;
//        }
//        return null;
//    }

}
