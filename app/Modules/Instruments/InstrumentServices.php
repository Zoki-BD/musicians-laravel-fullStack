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
      if ($id) {
         $instruments = $this->instrumentRepository->getInstrumentsById($id);
         return $instruments;
      }
      return null;
   }
}
