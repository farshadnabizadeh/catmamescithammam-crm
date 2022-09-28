<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use QRCode;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
class QRController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view() 
    {
      $qrCodeSimple = \QrCode::size(300)->generate('ReaderStacks');
       return view('qr-code',['qrCodeSimple'=>$qrCodeSimple]);
    }
}
