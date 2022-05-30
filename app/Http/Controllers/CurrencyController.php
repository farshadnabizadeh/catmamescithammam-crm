<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCurrencies()
    {
        try {
            $open = simplexml_load_file('https://www.tcmb.gov.tr/kurlar/today.xml');

            // dolar
            $usd_alis = $open->Currency[0]->BanknoteBuying;
            $usdSymbol = "$";
            $usd_satis = $open->Currency[0]->BanknoteSelling;

            // euro
            $euro_alis = $open->Currency[3]->BanknoteBuying;
            $euroSymbol = "€";
            $euro_satis = $open->Currency[3]->BanknoteSelling;

            // pound
            $gbp_alis = $open->Currency[4]->BanknoteBuying;
            $gbpSymbol = "£";
            $gbp_satis = $open->Currency[4]->BanknoteSelling;

            $test = $open->Currency[0]->CurrencyCode;

            $data = array('euroSymbol' => $euroSymbol, 'euroAlis' => $euro_alis, 'usdSymbol' => $usdSymbol, 'usdAlis' => $usd_alis, 'gbpSymbol' => $gbpSymbol, 'gbpAlis' => $gbp_alis);

            return json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
