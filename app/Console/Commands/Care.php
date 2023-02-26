<?php

namespace App\Console\Commands;

use App\Models\Plate;
use App\Models\PlateDocument;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Care extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:care';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle():array
    {
        $info = [];
        $today = Carbon::now()->format('Y-m-d');
        $plates = Plate::where('status', '!=', Plate::PLATE_STATUS_ARCHIVE)->get();

        foreach ($plates as $plate) {
            if (($plate->km - 200) >= ($plate->oil_km + $plate->oil_km_current)) {
                $info[] = $plate->plate . " Yağ bakımı yaklaşıyor";
            }

            $info[] = $this->plateDocument($plate->id);
        }
        return array_filter($info);
    }

    public function plateDocument(int $id_plate):array
    {
       $info = [];
       $platedocument =   PlateDocument::where('id_plate',$id_plate)->get();
        foreach ($platedocument as $item)
        {
            if (Carbon::parse($item->insurance_finish)->floatDiffInDays(Carbon::now()->format('Y-m-d')) <=  7) {
                $info[] = Plate::find($item->id_plate)->plate."  " . $item->type ."  Yaklaşıyor" ;
            }
        }
        return $info;
    }
}
