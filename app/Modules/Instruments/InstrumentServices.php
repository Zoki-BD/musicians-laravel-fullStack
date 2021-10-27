<?php


namespace App\Modules\Instruments;


class InstrumentServices
{

    private $instrumentRepository;


    public function __construct(InstrumentRepository $instrumentRepository)
    {
        $this->instrumentRepository = $instrumentRepository;
    }

    public function getAllInstruments($params)
    {
        $instruments = $this->instrumentRepository->getAllInstruments($params);
        return $instruments;
    }

    public function getInstrumentsById($id)
    {
        if($id) {
            $instruments = $this->instrumentRepository->getInstrumentsById($id);
            return $instruments;
        }
        return null;
    }
//
//    public function storeSports($data)
//    {
//        if($data) {
//            $Sports =  $this->instrumentRepository->storeSports($data);
//            return $Sports;
//        }
//        return null;
//    }
//
//    public function updateSports($id, $data)
//    {
//        if($id && $data) {
//            $Sports =  $this->instrumentRepository->updateSports($id, $data);
//            return $Sports;
//        }
//        return null;
//    }
//
//    public function deleteSports($id)
//    {
//        $Sports = $this->instrumentRepository->getSportsById($id);
//
//        if($Sports) {
//            $Sports = $this->instrumentRepository->deleteSports($id);
//            return $Sports;
//        }
//        return null;
//    }

}
