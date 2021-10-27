<?php

namespace App\Http\Controllers;

use App\Modules\Main\MainServices;
use Illuminate\Http\Request;

class MainController extends Controller
{
   public function index(MainServices $mainServices)
   {

      $musicians = $mainServices->getNumberOfRecords('musicians');
      $bands = $mainServices->getNumberOfRecords('bands');

      $musicians_on = $musicians->musicians_on;
      $musicians_off = $musicians->musicians_off;
      if (empty($musicians->musicians_on)) {
         $musicians_on = 0;
      }
      if (empty($musicians->musicians_off)) {
         $musicians_off = 0;
      }

      $bands_on = $bands->bands_on;
      $bands_off = $bands->bands_off;
      if (empty($bands->bands_on)) {
         $bands_on = 0;
      }
      if (empty($bands->bands_off)) {
         $bands_off = 0;
      }

      return view('/admin/main/index', compact(
         'musicians_on',
         'musicians_off',
         'bands_on',
         'bands_off'
      ));
   }
}
