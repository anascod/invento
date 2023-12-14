<?php

namespace App\Http\Controllers;
use App\Models\Supplymod;
use App\Models\Pay_supply;
use App\Models\Payhes;
use Redirect;
use DB;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;


use App\Http\Requests;

use Illuminate\Http\Request;

class Supply extends Controller
{
 public function index(Request $request){
    

    return view('supply');
    }

    
    function InsertSupp(Request $request)
    {

    $existingcsupp = Supplymod::where('supplu_name', $request->supplu_name)->first();

if ($existingcsupp) {
                Alert::warning('خطاء', '<H4>اسم العيل  مدخل مسبقا</H4>')->toHtml();
    return Redirect::to('/supply');
}else   { 

               $post=Supplymod::create([
'supplu_name'=> $request->supplu_name,
'supplu_email'=> $request->supplu_email,
'supplu_addr'=> $request->supplu_addr,
'supplu_phone'=> $request->supplu_phone,

]);
               Alert::success( '<H4>تم الاضافة بنجاح</H4>')->toHtml();
    return Redirect::to('/supply');
    }
}




 function ShowData()
    {

  $suppll = DB::select('select * from supply');
 $wartyArray = DB::select('select * from payhes');
  $paysup = DB::select('select * from pay_supply');
  $supplydata=array('suppll'=>$suppll);
  $paysupdata= array('paysup'=>$paysup);
  $hespdata= array('wartyArray'=>$wartyArray);
  // $hespata= array('datapayhes'=>$datapayhes);
  $alldata=Arr::collapse([$supplydata,$paysupdata,$hespdata]);

  return view('supply',$alldata);

    }



  
    function DeletData($id)
    {
  DB::delete('delete from supply where id = ?',[$id]);
 Alert::success( '<H4>تم الحذف بنجاح</H4>')->toHtml();
    return Redirect::to('/supply');

    }

     function SuppEdit(Request $request,$id) 
     {
      
   $existingcsupp = Supplymod::where('supplu_name', $request->supplu_nameedit)->first();

if ($existingcsupp) {
                Alert::warning('خطاء', '<H4>اسم العيل  مدخل مسبقا</H4>')->toHtml();
    return Redirect::to('/supply');
}else   { 
           $update = Supplymod::find($id);
        $update->supplu_name = $request->supplu_nameedit;
        $update->supplu_email = $request->supplu_addredit;
        $update->supplu_addr = $request->supplu_emailedit;
        $update->supplu_phone = $request->supplu_phoneedit;
        $update->save();
 Alert::success( '<H4>تم التعديل </H4>')->toHtml();
    return Redirect::to('/supply');
}
           }





           function Paysup(Request $request,$id){
                $now = date('Y-m-d H:i'); 
     $quan = DB::select('select * from pay_supply where id=?',[$id]);
foreach($quan as $quanti ){  
     $mainsu=$quanti->remaining - $request->payamount;
      
      if ($quanti->remaining==0) {
return redirect()->to('/supply')->with('message1','.');
      }

if ($quanti->remaining<$request->payamount) {
return redirect()->to('/supply')->with('message2','.');
      }

  $update = Pay_supply::find($id);
        $update->supplyname = $request->supplyname;
        $update->totalamount = $quanti->totalamount;
        $update->remaining = $mainsu;
        $update->save();

                      $post=Payhes::create([
'amount'=> $quanti->remaining,
'payment'=> $request->payamount,
'remain'=> $mainsu,
'pay_supply_id'=> $quanti->payid,
'created_at'=> $now,

]);
          }


                  return Redirect::to('/supply');

           }
   }

