<?php

namespace App\Http\Controllers;

use App\Modules\Main\MainServices;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(MainServices $mainServices)
    {

        $musicians=$mainServices->getNumberOfRecords('musicians');
        $bands=$mainServices->getNumberOfRecords('bands');

        $musicians_on=$musicians->musicians_on;
        $musicians_off=$musicians->musicians_off;
        if (empty($musicians->musicians_on)){$musicians_on=0;}
        if (empty($musicians->musicians_off)){$musicians_off=0;}

        $bands_on=$bands->bands_on;
        $bands_off=$bands->bands_off;
        if (empty($bands->bands_on)){$bands_on=0;}
        if (empty($bands->bands_off)){$bands_off=0;}

        return view('/admin/main/index', compact(
            'musicians_on',
            'musicians_off',
            'bands_on',
            'bands_off'
        ));


        //$main=$mainServices->getNumberOfRecords();
//        $federations=$mainServices->getNumberOfRecords('federations');
//        $clubs=$mainServices->getNumberOfRecords('clubs');
//        $athletes=$mainServices->getNumberOfRecords('athletes');
//        $coaches=$mainServices->getNumberOfRecords('coaches');
//        $judges=$mainServices->getNumberOfRecords('judges');
//        $objects=$mainServices->getNumberOfRecords('objects');

//        dd($federations->federations_on);

//        $federations_on=$federations->federations_on;
//        $federations_off=$federations->federations_off;
//        if (empty($federations->federations_on)){$federations_on=0;}
//        if (empty($federations->federations_off)){$federations_off=0;}
//
//        $clubs_on=$clubs->clubs_on;
//        $clubs_off=$clubs->clubs_off;
//        if (empty($clubs->clubs_on)){$clubs_on=0;}
//        if (empty($clubs->clubs_off)){$clubs_off=0;}
//
//        $athletes_on=$athletes->athletes_on;
//        $athletes_off=$athletes->athletes_off;
//        if (empty($athletes->athletes_on)){$athletes_on=0;}
//        if (empty($athletes->athletes_off)){$athletes_off=0;}
//
//        $coaches_on=$coaches->coaches_on;
//        $coaches_off=$coaches->coaches_off;
//        if (empty($coaches->coaches_on)){$coaches_on=0;}
//        if (empty($coaches->coaches_off)){$coaches_off=0;}
//
//        $judges_on=$judges->judges_on;
//        $judges_off=$judges->judges_off;
//        if (empty($judges->judges_on)){$judges_on=0;}
//        if (empty($judges->judges_off)){$judges_off=0;}
//
//
//        $objects_on=$objects->objects_on;
//        $objects_off=$objects->objects_off;
//        if (empty($objects->objects_on)){$objects_on=0;}
//        if (empty($objects->objects_off)){$objects_off=0;}
//
//
//        return view('/admin/main/index', compact(
//            'federations_on',
//            'federations_off',
//            'clubs_on',
//            'clubs_off',
//            'athletes_on',
//            'athletes_off',
//            'coaches_on',
//            'coaches_off',
//            'judges_on',
//            'judges_off',
//            'objects_on',
//            'objects_off'
//        ));


    }
}
