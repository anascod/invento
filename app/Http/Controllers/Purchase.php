<?php

namespace App\Http\Controllers;


use App\Models\Purchasemod;
use App\Models\Supplymod;
use App\Models\pay_supply;
use App\Models\Productmod;
use Redirect;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Routing\Redirector;

class Purchase extends Controller
{

  function Purindex(Request $request){

     $req="disable";

     return view('/purchase',$req);
 }




 function InsertPur(Request $request)
 {


    if ($request->amount >= $request->payprice ) {
Alert::warning('خطاء', '<H4>الدفعة الاولة اكبر من او يساوي مبلغ الشراء</H4>')->toHtml();
  return Redirect::to('/purchase');
    }
    else{ 

       $dataprodic = Productmod::
       where('proname',$request->itemname)
       ->where('prounite',$request->purunit)
       ->get();
       if ($dataprodic->isEmpty()) {
      Alert::warning('خطاء', '<H4>المنتج و الوحدة غير متطابقة</H4>')->toHtml();
 

  return Redirect::to('/purchase');

    }else{ 
         $totalam=$request->payprice-$request->amount;
        $amount = $request->amount;
        $amount = empty($amount) ? 0 : $amount;

        $post=Purchasemod::create([
            'purnum'=> $request->purnum,
            'itemname'=>$request->itemname,
            'purquan'=> $request->purquan,
            'purunit'=>$request->purunit,
            'supply'=>$request->supply,
            'paytype'=>$request->paytype,
            'amount'=> $amount,
            'payprice'=>$request->payprice,
            'selprice'=>$request->selprice
        ]);
        
        if (!empty($amount)) {

            $post = new pay_supply;

            $post->supplyname = $request->supply;
            $post->totalamount = $request->payprice;
            $post->remaining = $totalam;
            $post->payid =  $request->payprice;
            $post->save();

           // code...
        }
 $suplar= DB::table('product')
 ->where('proname',$request->itemname)
 ->where('prounite',$request->purunit)
 ->increment('proquan', $request->purquan  );

Alert::success('<H3>تم  الاضافة بنجاح  </H3>', '')->toHtml();
  return Redirect::to('/purchase');
    }
}
}


function ShowPurData()
{
  $supplyna = DB::select('select * from supply');
  $itemes = DB::table('product')->get();
$names = [];
  $cus = DB::select('select * from purchase');
  $pur=array('cus'=>$cus);
  $pro=array('itemes'=>$itemes);
  $proname=array('names'=>$names);
  $supp= array('supplyna'=>$supplyna);
  $all_r=Arr::collapse([$pur,$supp,$pro,$proname]);

  return view('purchase',$all_r);

}


function DeletPurData($id)
{

    $cus = DB::select('select * from purchase where id=?',[$id]);
    foreach($cus as $webcas ){ 

      $deces= $webcas->payprice - $webcas->amount;
      $suplar= DB::table('supply')
      ->where('supplu_name',$webcas->supply)
      ->decrement('amount',$deces  );
     
      $suplar= DB::table('product')
      ->where('proname',$webcas->itemname)
      ->where('prounite',$webcas->purunit)
      ->decrement('proquan', $webcas->purquan);

      DB::delete('delete from pay_supply where payid = ?',[$webcas->payprice]);
      DB::delete('delete from payhes where pay_supply_id = ?',[$webcas->payprice]);
  }
  DB::delete('delete from purchase where id = ?',[$id]);
Alert::success('<H3>تم  الحذف بنجاح  </H3>', '')->toHtml();
  return Redirect::to('/purchase');

}





function PurEdit(Request $request,$id) 
{
    $amount = $request->amount;
    $amount = empty($amount) ? 0 : $amount;
    $update = Purchasemod::find($id);
    $update->purnum = $request->purnum;
    $update->itemname = $request->itemname;
    $update->purquan = $request->purquan;
    $update->purunit = $request->purunit;
    $update->supply = $request->supply;
    $update->paytype = $request->paytype;
    $update->amount = $amount;
    $update->payprice = $request->payprice;
    $update->selprice = $request->selprice;

    if ($request->amount >= $request->payprice ) {
Alert::warning('خطاء', '<H4>الدفعة الاولة اكبر من او يساوي مبلغ الشراء</H4>')->toHtml();
  return Redirect::to('/purchase');

    }

    else{ 
       $quan = DB::select('select * from purchase where id=?',[$id]);
       foreach($quan as $quanti ){ 
          $minus= $quanti->purquan - $request->purquan;
          $pluss= ($request->purquan) - $quanti->purquan;
          $newrem=$quanti->payprice-$request->amount;
          
          if ($request->purquan > $quanti->purquan) {
         
           $suplar= DB::table('product')
          ->where('proname',$quanti->itemname)
          ->where('prounite',$quanti->purunit)
          ->increment('proquan',$pluss);
         

          }else{
    $suplar= DB::table('product')
          ->where('proname',$quanti->itemname)
          ->where('prounite',$quanti->purunit)
          ->decrement('proquan',$minus);
       
          }
          

           if (!empty($amount)) {
$amoupay=pay_supply::where('payid',$quanti->payprice)
->update(['totalamount'=>$request->payprice,'remaining'=>$newrem,'payid'=>$request->payprice]);
      }


  }
      $update->save();
Alert::success('<H3>تم  التعديل بنجاح  </H3>', '')->toHtml();

  return Redirect::to('/purchase');
  }

}
}
