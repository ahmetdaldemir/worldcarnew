<?php

namespace App\Console\Commands;

use App\Helpers\Campain;
use App\Models\Camping;
use App\Models\Currency as CurrencyModel;
use Illuminate\Console\Command;
use Teknomavi\Tcmb\Doviz;
use \DB;


class Currency extends Command
{

    protected $signature = 'cron:currency';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $doviz = new Doviz();

        $url	  = "http://api.exchangeratesapi.io/latest?access_key=5cff66816d3f2f7855f29fc646b042c0&from=EUR";
        $content  = file_get_contents($url);
        $row 	  = json_decode($content);
        $result   = $row->rates;

        $currencys = CurrencyModel::where("left_icon","!=","TRY")->get();
        foreach ($currencys as $currency) {
            $currency->price_buy = $doviz->kurAlis($currency->left_icon, Doviz::TYPE_EFEKTIFALIS);
            $currency->price_sell = $doviz->kurSatis($currency->left_icon, Doviz::TYPE_EFEKTIFSATIS);
            $currency->save();
        }

        $currencyexchange = CurrencyModel::where("left_icon","!=","EUR")->get();
        foreach ($currencyexchange as $currency) {
            $currency->exchange = $result->{$currency->left_icon};
            $currency->save();
        }

        $currencyeur = CurrencyModel::where("left_icon","EUR")->first();
        $currencyeur->exchange = 1;
        $currencyeur->save();


    }
}
