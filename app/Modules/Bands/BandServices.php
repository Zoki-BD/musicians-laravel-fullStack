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
      $bands = $this->bandRepository->getAllBandsSif();
      return $bands;
   }

   public function getBandsById($id)
   {
      if ($id) {
         $bands = $this->bandRepository->getBandsById($id);
         return $bands;
      }
      return null;
   }
   //

   //
   public function storeBands($data, $pictures_name)
   {
      if ($data) {
         $bands =  $this->bandRepository->storeBands($data, $pictures_name);
         return $bands;
      }
      return null;
   }
   //


   public function updateBands($id, $data, $pictures_name)
   {
      if ($id && $data) {
         $bands =  $this->bandRepository->updateBands($id, $data, $pictures_name);
         return $bands;
      }
      return null;
   }

   public function deleteBands($id)
   {
      $bands = $this->bandRepository->getBandsById($id);

      if ($bands) {
         $bands = $this->bandRepository->deleteBands($id);
         return $bands;
      }
      return null;
   }
}
