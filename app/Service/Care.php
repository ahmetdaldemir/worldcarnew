<?php

namespace App\Service;

use App\Models\Plate;
use App\Models\PlateDocument;
use Carbon\Carbon;

class Care
{

    public function start()
    {
        $info = [];
        $today = Carbon::now()->format('Y-m-d');
        $plates = Plate::where('status', '!=', Plate::PLATE_STATUS_ARCHIVE)->get();
        foreach ($plates as $plate) {
            if(!is_null($plate->km))
            {
                if (($plate->km - 200) >= ($plate->oil_km + $plate->oil_km_current)) {
                    $info[] = array(
                        'plate' =>  $plate->plate,
                        'type'  => "",
                        'text'  => "Yağ bakımı yaklaşıyor",
                        'date'  => "",
                    );
                }
                $info[] = $this->plateDocument($plate->id);
            }
        }
        return $info;
    }


    public function plateDocument(int $id_plate)
    {
        $infos = [];
        $today = Carbon::now()->format('Y-m-d');
        $platedocument =   PlateDocument::where('id_plate',$id_plate)->get();
        foreach ($platedocument as $item)
        {
            $insuredate = Carbon::parse($item->insurance_finish)->floatDiffInDays(Carbon::now()->format('Y-m-d'));
            if ($insuredate <=  7 || $item->insurance_finish < $today) {
                $infos[] = array(
                    'plate' => Plate::find($item->id_plate)->plate,
                    'type'  => $item->type,
                    'text'  => "Yaklaşıyor",
                    'date'  => Carbon::parse($item->insurance_finish)->format('d-m-Y'),
                );
            }

        }
        return $infos;
    }
}
