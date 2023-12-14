<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use DB;
use PDF;
use App\Models\Sell_pro;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;

class invoice extends Controller
{
       public function Invindex(Request $request){

       
    return view('invoice');
}

    function ShowInvoData()
    {



  $invoiceNumber=session()->get('invo');
  $sek=DB::table('sellhes')->get();


    $data = json_decode($sek, true, JSON_UNESCAPED_UNICODE);

  $invonoValues = [];
    $pronameValues = [];
    $proquanValues = [];
    $prounitValues = [];
    $totalValues = [];

foreach ($data as $item) {
    $invonoValues[] = array_map('trim', explode(',', $item['invono']));
    $prounitValues[] = array_map('trim', explode(',', $item['prounite']));
    $pronameValues[] = array_map('trim', explode(',', $item['proname']));
    $proquanValues[] = array_map('trim', explode(',', $item['proquan']));
    $totalValues[] = array_map('trim', explode(',', $item['total']));

foreach ($invonoValues as $key => $invonoValue) {
    $prounitValue = isset($prounitValues[$key]) ? $prounitValues[$key] : '';
    $pronameValue = isset($pronameValues[$key]) ? $pronameValues[$key] : '';
    $proquanValue = isset($proquanValues[$key]) ? $proquanValues[$key] : '';
    $totalValue   = isset($totalValues[$key]) ? $totalValues[$key] : '';




}

}
  $invonoprodata = [
        'invonoValues' => session()->get('invo'),
        'prounitValues' => $prounitValues,
        'pronameValues' => $pronameValues,
        'proquanValues' => $proquanValues,
        'totalValues' => $totalValues,
        'custname' => session()->get('input_data')['custname'],
    ];
     $saee = Sell_pro::where("invono",session()->get('invo'));
      // share data to view
      view()->share('inovice',$invonoprodata);
      $pdf = PDF::loadView('invoice', $invonoprodata);
      // download PDF file with download method
      
            $alldata= array('data'=>$data);

  $all_r=Arr::collapse([$alldata]);

 
      return view('invoice',$all_r);




}
}
