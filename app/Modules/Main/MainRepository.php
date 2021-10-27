<?php


namespace App\Modules\Main;


use Illuminate\Support\Facades\DB;

class MainRepository
{
    public function getNumberOfRecords($type)
    {

       // $federations=Federations::where('deleted', '=', '0');

        $array = DB::table($type)->where('deleted', '=', '0')
            ->select(DB::raw('sum(case when deactivated=0 then 1 end) as '.$type.'_on'),
                DB::raw('sum(case when deactivated=1 then 1 end) as '.$type.'_off'))
            ->first();

//dd($federations);
//        dd($array);
        return $array;

    }

}
