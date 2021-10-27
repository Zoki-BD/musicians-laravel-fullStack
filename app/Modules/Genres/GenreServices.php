<?php


namespace App\Modules\Genres;





class GenreServices
{

    private $genreRepository;


    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function getAllGenres($params)
    {
        $genres = $this->genreRepository->getAllGenres($params);
        return $genres;
    }

    public function getGenresById($id)
    {
        if($id) {
            $genres = $this->genreRepository->getGenresById($id);
            return $genres;
        }
        return null;
    }

// ova e za da ni dade opcii za da imame pole vo edit i vo show kad eke bidat prikazani gradovite kade nastapuva nekoj bend
    public function getBandsGenresById($id) {


            $genres = $this->genreRepository->getBandsGenresById($id);
            return $genres;

    }

    //ova e da moze vo edit da popolnime polinjata prethodno dobieni so get gore
    public function insertBandsGenresById($id_bands) {

        if($id_bands) {
            $genres = $this->genreRepository->insertBandsGenresById($id_bands);
            return $genres;
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
