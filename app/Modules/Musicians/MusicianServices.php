<?php


namespace App\Modules\Musicians;


class MusicianServices
{

    private $musicianRepository;

    public function __construct(MusicianRepository $musicianRepository)
    {
        //dd($musicianRepository);
        $this->musicianRepository = $musicianRepository;
    }

    //________________________________________________________________________________________________
    public function getAllMusicians($params)
    {
        $musicians = $this->musicianRepository->getAllMusicians($params);
        return $musicians;
    }

    //________________________________________________________________________________________________
    public function getMusiciansById($id)
    {
        if($id) {
            $musicians = $this->musicianRepository->getMusiciansById($id);
            return $musicians;
        }
        return null;
    }

    //________________________________________________________________________________________________
    public function getMusiciansByIdBands($id)
    {
        if($id) {
            $musicians = $this->musicianRepository->getMusiciansByIdBands($id);
            return $musicians;
        }
        return null;
    }

    //________________________________________________________________________________________________
    public function storeMusicians($data, $pictures_name)
    {
        if($data) {
            $musicians = $this->musicianRepository->storeMusicians($data, $pictures_name);
            return $musicians;
        }
          return null;
    }

    //________________________________________________________________________________________________
    public function updateMusicians($id, $data, $pictures_name)
    {
        if($id && $data) {
            $musicians =  $this->musicianRepository->updateMusicians($id, $data, $pictures_name);
            return $musicians;
        }
        return null;
    }

    //________________________________________________________________________________________________
    public function deleteMusicians($id)
    {
        $musicians = $this->musicianRepository->getMusiciansById($id);

        if($musicians) {
            $musicians = $this->musicianRepository->deleteMusicians($id);
            return $musicians;
        }
        return null;
    }

}