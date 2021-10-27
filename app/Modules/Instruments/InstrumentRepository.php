<?php


namespace App\Modules\Instruments;

use App\Models\Instrument;

class InstrumentRepository
{
    public function getAllInstruments($params)
    {
        $instruments = Instrument::orderBy('name', 'ASC')->get();

        return $instruments;

    }


    public function getInstrumentsById($id)
    {
        if($id) {
            $instruments = Instrument::where('id', '=', $id)->first();
            return $instruments;
        }
        return null;
    }
//
//
//    public function storeInstruments($data)
//    {
//
//        $instruments = Instrument::create([
//            'name' => $data['name'],
//            'created_at' => $data['created_at'],
//            'updated_at' => $data['updated_at']
//
//        ]);
//
//        return $instruments;
//
//    }
//
//
//    public function updateInstruments($id, $data)
//    {
//        $instruments = $this->getInstrumentsById($id);
//
//        if($instruments) {
//
//            $instruments->name =$data['name'];
//            $instruments->created_at = $data['created_at'];
//            $instruments->updated_at = $data['updated_at'];
//
//            return $instruments->save();
//        }
//        return null;
//    }
//
//
//    public function deleteInstruments($id)
//    {
//        $instruments = $this->getInstrumentsById($id);
//
//        if($instruments) {
//           // $instruments =instruments::where('id', '=', $id)->delete();
//            $instruments->deleted = 1;
//            //dd($instruments);
//            return $instruments->save();
//        }
//        return null;
//
//    }
}
