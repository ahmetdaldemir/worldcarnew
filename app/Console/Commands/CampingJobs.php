<?php

namespace App\Console\Commands;

use App\Helpers\Campain;
use App\Models\Camping;
use Illuminate\Console\Command;

class CampingJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campain:jobs';

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
    public function handle()
    {
        $campain =  Campain::all();
        foreach ($campain as $item)
        {
            if($item->finish_date < date("Y-m-d"))
            {
                $campainUpdate = Camping::find($item->id);
                $campainUpdate->status = 0;
                $campainUpdate->save();
            }
        }
    }
}
