<?php


namespace App\Modules\Bands;



class BandServices
{

    private $bandRepository;


    public function __construct(BandRepository $bandRepository)
    {
        $this->bandRepository = $bandRepository;
    }

    public function getAllBands($params)
    {
        $bands = $this->bandRepository->getAllBands($params);
        return $bands;
    }

    public function getAllBandsSif()
    {
        $bands= $this->bandRepository->getAllBandsSif();
        return $bands;
    }

    public function getBandsById($id)
    {
        if($id) {
            $bands= $this->bandRepository->getBandsById($id);
            return $bands;
        }
        return null;
    }
//
//    public function getClubsByIdFederations($id)
//    {
//        if($id) {
//            $clubs = $this->clubsRepository->getClubsByIdFederations($id);
//            return $clubs;
//        }
//        return null;
//    }
//
    public function storeBands($data, $pictures_name)
    {
        if($data) {
            $bands =  $this->bandRepository->storeBands($data, $pictures_name);
            return $bands;
        }
        return null;
    }
//


    public function updateBands($id, $data, $pictures_name)
    {
        if($id && $data) {
            $bands =  $this->bandRepository->updateBands($id, $data, $pictures_name);
            return $bands;
        }
        return null;
    }

    public function deleteBands($id)
    {
        $bands = $this->bandRepository->getBandsById($id);

        if($bands) {
            $bands = $this->bandRepository->deleteBands($id);
            return $bands;
        }
        return null;
    }
//    public function getClubsCategoryAgeById($id)
//    {
//        if($id) {
//            $clubs_sports = $this->clubsRepository->getClubsCategoryAgeById($id);
//            return $clubs_sports;
//        }
//        return null;
//    }
//
//    public function insertClubsCategoryAgeById($id_clubs,$id_category_age)
//    {
//        {
//            if($id_clubs) {
//                $clubs_category_age = $this->clubsRepository->insertClubsCategoryAgeById($id_clubs,$id_category_age);
//                return $clubs_category_age;
//            }
//            return null;
//        }
//    }
//
//
//    public function insertClubsObjectsById($id_clubs,$id_objects)
//    {
//        {
//            if($id_clubs) {
//                $clubs_objects= $this->clubsRepository->insertClubsObjectsById($id_clubs,$id_objects);
//                return $clubs_objects;
//            }
//            return null;
//        }
//    }
//    public function getExportClubs($data)
//    {
//        if($data) {
//            $clubs =  $this->clubsRepository->getExportClubs($data);
//            return $clubs;
//        }
//        return null;
//    }

}
