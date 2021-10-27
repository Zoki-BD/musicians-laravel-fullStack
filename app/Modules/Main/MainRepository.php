<?php


namespace App\Modules\Main;


use Illuminate\Support\Facades\DB;

class MainRepository
{
   public function getNumberOfRecords($type)
   {



      $array = DB::table($type)->where('deleted', '=', '0')
         ->select(
            DB::raw('sum(case when deactivated=0 then 1 end) as ' . $type . '_on'),
            DB::raw('sum(case when deactivated=1 then 1 end) as ' . $type . '_off')
         )
         ->first();


      return $array;
   }
}
