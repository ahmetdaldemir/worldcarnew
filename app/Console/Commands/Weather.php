<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Weather as WeatherModel;

class Weather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cnn:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CNNTURK Weather apisinden data allmak için kullanılıyor';

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
       
    }
}
