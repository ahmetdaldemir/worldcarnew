<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Finance as FinanceModel;

class Finance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cnn:finance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CNNTURK Finance apisinden data allmak için kullanılıyor';

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
        FinanceModel::truncate();

        $datas = file_get_contents("https://www.cnnturk.com/api/finance");
        $datas = json_decode($datas,TRUE);
        foreach($datas as $data)
        {
            $finance = new FinanceModel();
            $finance->ixname = $data['ixname'];
            $finance->display_name = $data['display_name'];
            $finance->date = $data['date'];
            $finance->last = $data['last'];
            $finance->change = $data['change'];
            $finance->percent = $data['percent'];
            $finance->status = $data['status'];
            $finance->yesterday = json_encode($data['yesterday']);
            $finance->save();
        }
        FinanceModel::whereIn('ixname',['gold','btxntry','btctry','ethtry','brent','bist'])->delete();
    }
}
