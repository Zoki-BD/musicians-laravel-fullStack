<?php


namespace App\Modules\Main;


class MainServices
{

    private $mainRepository;


    public function __construct(mainRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getNumberOfRecords($type)
    {
        $Main = $this->mainRepository->getNumberOfRecords($type);
        return $Main;
    }


}
