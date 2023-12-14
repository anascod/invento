<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sellesmod;
use App\Models\Sell_pro;
use App\Models\sellhes;
use App\Models\Cus_pay;
use App\Models\Customermod;
use App\Models\Productmod;
use Redirect;
use DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;

class Invoices extends Controller
{

function InvoView(){


return view('invoices');
}

 function ShowInvo()
    {
          
  

$valew=DB::table('sell_pro')->get();
$customerna=DB::table('customer')->get();

$invo = sellhes::orderBy('created_at')->get();
$allInvoiceData = [];

$prododata= DB::table('product')->get();



$sek=DB::table('sellhes')->get();
$das =explode(" , ", $sek);

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
  $dataes = [
        'invonoValues' => $invonoValues,
        'prounitValues' => $prounitValues,
        'pronameValues' => $pronameValues,
        'proquanValues' => $proquanValues,
        'totalValues' => $totalValues,
    ];


  $additio=Sell_pro::sum('total');
  // $prouni= array('sells'=>$sells);
  $nibl= array('invo'=>$invo);
  $cusname= array('customerna'=>$customerna);
  $prodarw= array('prododata'=>$prododata);
  $alldata= array('data'=>$data);
  $summ= array('additio'=>$additio);
  $all_r=Arr::collapse([$nibl,$summ,$alldata,$dataes,$cusname,$prodarw]);
      return view('invoices',$all_r);

    }


function EditInvo(Request $request,$id)
{


       $quan = DB::select('select * from sellhes where id=?',[$id]);
$sek=sellhes::select()->where('id',$id)->get();


            $data = json_decode($sek, true, JSON_UNESCAPED_UNICODE);

  $invonoValues = [];
    $pronameValues = [];
    $proquanValues = [];
    $prounitValues = [];
    $totalValues = [];

foreach ($data as $item) {
    $invonoValues[] = array_map('trim', explode(',', $item['invono']));
      $prounitValues = array_map('trim', explode(',', $item['prounite']));
                $pronameValues= array_map('trim', explode(',', $item['proname']));
                $proquanValues = array_map('trim', explode(',', $item['proquan']));
                $totalValues = array_map('trim', explode(',', $item['total']));

foreach ($pronameValues as $key => $pronameValue){ 
      $totalValue   = isset($totalValues[$key]) ? $totalValues[$key] : '';

     $pluss =   intval($request->proquan[$key])-intval($proquanValues[$key])  ;
     $minss =   intval($proquanValues[$key])-intval($request->proquan[$key])  ;
 
 if ($request->proquan[$key] > $proquanValues[$key]) {
         
           $suplar= DB::table('product')
          ->where('proname',$pronameValue)
          ->where('prounite',$prounitValues[$key])
          ->increment('proquan',$minss);
         

          }else{
    $suplar= DB::table('product')
         ->where('proname',$pronameValue)
          ->where('prounite',$prounitValues[$key])
          ->decrement('proquan',$pluss);
       
          } 
        }
         
 }           $update = sellhes::find($id);

    $update->proname  = implode(', ', $request->proname);
    $update->proquan = implode(', ', $request->proquan);
    $update->total = implode(', ', $request->prototal);
    $update->prounite = implode(', ', $request->prounit);
    $update->custname = $request->custname;
    $update->save();
 Alert::success( '<H4>تم  التعديل بنجاح</H4>')->toHtml();

return Redirect::to('invoices');
}







function showinvoice(Request $request,$invnum){


$valew=Cus_pay::select('firstpay')->where('invono',$invnum)->get();
$firstpay = (int) $valew->pluck('firstpay')->first();

$customerna=DB::table('customer')->get();
$invo = sellhes::orderBy('created_at')->get();

$custnam=DB::table('sellhes')->where('invono',$invnum)->get();

$sek=sellhes::select()->where('invono',$invnum)->get();
$das =explode(" , ", $sek);
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
                $proquanValues []= array_map('trim', explode(',', $item['proquan']));
                $totalValues  []= array_map('trim', explode(',', $item['total']));

foreach ($invonoValues as $key => $invonoValue) {
      $totalValue   = isset($totalValues[$key]) ? $totalValues[$key] : '';




}

}
  $dataes = [
        'invonoValues' => $invonoValues,
        'prounitValues' => $prounitValues,
        'pronameValues' => $pronameValues,
        'proquanValues' => $proquanValues,
        'totalValues' => $totalValues,
    ];

  $additio=Sell_pro::sum('total');
  // $prouni= array('sells'=>$sells);
  $nibl= array('invo'=>$invo);
  $cusname= array('customerna'=>$customerna);
  $cusbi= array('custnam'=>$custnam);
  $alldata= array('data'=>$data);
  $summ= array('additio'=>$additio);
  $all_r=Arr::collapse([$nibl,$summ,$alldata,$dataes,$cusname,$cusbi]);

return view('invocheck', ['data'=>$data,'invo'=>$invo,'custnam'=>$custnam,'totalValues' => $totalValues,'invnum'=>$invnum,'firstpay'=>$firstpay ]);
}


function DeletInvoices($id){
   $newq=sellhes::select()->where('invono', $id)->get();


            $update = json_decode($newq, true, JSON_UNESCAPED_UNICODE);




  

            $invonoValues = [];
            $pronameValues = [];
            $proquanValues = [];
            $prounitValues = [];
            $totalValues = [];

            foreach ($update as $item) {

                $prounitValues = array_map('trim', explode(',', $item['prounite']));
                $pronameValues = array_map('trim', explode(',', $item['proname']));
                $proquanValues = array_map('trim', explode(',', $item['proquan']));
                $totalValues  = array_map('trim', explode(',', $item['total']));

                foreach ($pronameValues as $key => $pronameValue) {
    $totalValue   = isset($totalValues[$key]) ? $totalValues[$key] : '';

                    $suplar= DB::table('product')
                    ->where('proname',$pronameValue)
                    ->where('prounite',$prounitValues[$key])
                    ->increment('proquan', intval($proquanValues[$key]));
                }

            }

DB::delete('delete from sellhes  where invono = ?',[$id]);
 Alert::success( '<H4>تم الحذف بنجاح</H4>')->toHtml();
    return Redirect::to('/invoices');

}


function AddPro(Request $request,$invoice)
{
$prods=Productmod::where('proname',$request->proname)->where('prounite',$request->prounit)->first();
    $totalPrice = $request->proquan * $prods->proprice;

$reletiv=Sellhes::select()->where('invono',$invoice)->get();
$pronameArray = [];
$proquanArray = [];
$prouniteArray = [];
$totalArray = [];

foreach ($reletiv as $reletivItem) {
   $pronameArray[] = $reletivItem->proname;
   $proquanArray[] = $reletivItem->proquan;
   $prouniteArray[] = $reletivItem->total;
   $totalArray[] = $reletivItem->prounite;
}
$newProname = implode(', ', $pronameArray) . ', ' . $request->proname;
$newProquan = implode(', ', $proquanArray) . ', ' . $request->proquan;
$newProunite = implode(', ', $prouniteArray) . ', ' . $totalPrice;
$newTotal = implode(', ', $totalArray) . ', ' . $request->prounit;
$updateSell = Sellhes::where('invono', $invoice)->first();

    $suplar= DB::table('product')
         ->where('proname',$request->proname)
          ->where('prounite',$request->prounit)
          ->decrement('proquan',$request->proquan);
          if ($suplar>0) {
            
         

$updateSell->proname  = $newProname;
    $updateSell->proquan = $newProquan;
    $updateSell->total = $newProunite;
    $updateSell->prounite = $newTotal;
    $updateSell->save();
Alert::success( '<H4>تم الاضافة بنجاح</H4>')->toHtml();
    return Redirect::to('/invoices');
 }else
 {
Alert::warning('خطاء', '<H4>المنتج و الكمية غير مطابقة </H4>')->toHtml();
    return Redirect::to('/invoices');

 }

}


function Deletitem(Request $request )
{
    $inv = $request->input('inv');
    $proname = $request->input('proname');
    $proquan = $request->input('proquan');
     $prounit = $request->input('prounit');
     $prototal = $request->input('prototal');

$checj=sellhes::select()->where('invono',$inv)->get();
$pronameArray = [];
$proquanArray = [];
$prouniteArray = [];
$totalArray = [];

foreach ($checj as $reletivItem) {
   $pronameArray[] = $reletivItem->proname;
   $proquanArray[] = $reletivItem->proquan;
   $prouniteArray[] = $reletivItem->total;
   $totalArray[] = $reletivItem->prounite;

                $prounitValues = array_map('trim', explode(',', $reletivItem['prounite']));
                $pronameValues = array_map('trim', explode(',', $reletivItem['proname']));
                $proquanValues = array_map('trim', explode(',', $reletivItem['proquan']));
                $totalValues  = array_map('trim', explode(',', $reletivItem['total']));

  $combinedValues = array_map(
        function ($pronameValue, $proquanValue, $prounitValue, $totalValue) {
            return [
                'proname' => $pronameValue,
                'proquan' => $proquanValue,
                'prounit' => $prounitValue,
                'prototal' => $totalValue
            ];
        },
        $pronameValues,
        $proquanValues,
        $prounitValues,
        $totalValues
    );

    // Filter the combined array to remove items based on the specified conditions
    $filteredValues = array_filter($combinedValues, function ($value) use ($proname, $proquan, $prounit, $prototal) {
        return $value['proname'] !== $proname || 
               $value['proquan'] !== $proquan || 
               $value['prounit'] !== $prounit || 
               $value['prototal'] !== $prototal;
    });

    // Separate the filtered values back into separate arrays
    $filteredPronameValues = array_column($filteredValues, 'proname');
    $filteredProquanValues = array_column($filteredValues, 'proquan');
    $filteredProunitValues = array_column($filteredValues, 'prounit');
    $filteredTotalValues = array_column($filteredValues, 'prototal');

    // Update the database with the filtered values
    $updateSell = Sellhes::where('invono', $inv)->first();
    $updateSell->proname = implode(', ', $filteredPronameValues);
    $updateSell->proquan = implode(', ', $filteredProquanValues);
    $updateSell->prounite = implode(', ', $filteredProunitValues);
    $updateSell->total = implode(', ', $filteredTotalValues);
    $updateSell->save();

        $suplar= DB::table('product')
         ->where('proname',$proname)
          ->where('prounite',$prounit)
          ->increment('proquan',$proquan);
    
 Alert::success( '<H4>تم الحذف بنجاح</H4>')->toHtml();
    return Redirect::to('/invoices');



}
}

}