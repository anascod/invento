<?php

namespace App\Http\Controllers;
use App\Models\Customermod;
use Redirect;
use DB;
use App\Models\Cus_pay;
use App\Models\Cus_phes;
use Illuminate\Support\Arr;
use App\Http\Requests;
use RealRashid\SweetAlert\Facades\Alert;



use Illuminate\Http\Request;

class Customer extends Controller
{
    
 public function index(Request $request){
  
    return view('customer');
    }

    
    function InsertCus(Request $request)
    {
    $existingcost = Customermod::where('cusname', $request->supplu_name)->first();

if ($existingcost) {
                Alert::warning('خطاء', '<H4>اسم العيل  مدخل مسبقا</H4>')->toHtml();
    return Redirect::to('/customer');
}
 $post = new Customermod;
        $post->cusname = $request->supplu_name;
        $post->cusemail = $request->supplu_email;
        $post->cusadd = $request->supplu_addr;
        $post->cusphone = $request->supplu_phone;
        $post->save();
Alert::success( '<H4>تم الحفظ</H4>')->toHtml();
    return Redirect::to('/customer');
    }


    function ShowCusData()
    {
             $wartyArray = DB::select('select * from cus_phes');

              $paysup = DB::select('select * from cus_pay');
              // $paysup = pay_supply::with('Payhes')->get();
              // $wartyArray = Payhes::with('pay_supply')->get();
            
              $cus = DB::select('select * from customer');



              $paysupdata= array('paysup'=>$paysup);
              $hespdata= array('wartyArray'=>$wartyArray);
              $cusdta= array('cus'=>$cus);
              // $hespata= array('datapayhes'=>$datapayhes);
              $alldata=Arr::collapse([$paysupdata,$hespdata,$cusdta]);

      return view('customer',$alldata);
      

    }

  
    function DeletCusData($id)
    {
  DB::delete('delete from customer where id = ?',[$id]);
  Alert::success('<H4>تم الحذف بنجاح</H4>')->toHtml();
    return Redirect::to('/customer');

    }

     function CusEdit(Request $request,$id) 
     {
      
    $existingcost = Customermod::where('cusname', $request->supplu_nameedit)->first();

if ($existingcost) {
                Alert::warning('خطاء', '<H4>اسم العيل  مدخل مسبقا</H4>')->toHtml();
    return Redirect::to('/customer');
}
           $update = Customermod::find($id);
        $update->cusname = $request->supplu_nameedit;
        $update->cusemail = $request->supplu_addredit;
        $update->cusadd  = $request->supplu_emailedit;
        $update->cusphone = $request->supplu_phoneedit;
        $update->save();
Alert::success('خطاء', '<H4>تم التعديل بنجاح</H4>')->toHtml();
    return Redirect::to('/customer');

           }
   


   function Cuspay(Request $request,$id){
                $now = date('Y-m-d H:i'); 
     $quan = DB::select('select * from cus_pay where id=?',[$id]);
foreach($quan as $quanti ){  
     $mainsu=$quanti->reminam - $request->payamount;
      
      if ($quanti->reminam==0) {
return redirect()->to('/customer')->with('message1','.');
      }

if ($quanti->reminam<$request->payamount) {
return redirect()->to('/customer')->with('message2','.');
      }

  $modi = Cus_pay::find($id);
        $modi->cusname = $request->supplyname;
        $modi->totamount = $quanti->totamount;
        $modi->reminam = $mainsu;
        $modi->save();

                      $post=Cus_phes::create([
'invono'=> $quanti->invono,
'totamount'=> $quanti->totamount,
'payment'=> $request->payamount,
'reminam'=> $mainsu,
'created_at'=> $now,

]);
          }


                  return Redirect::to('/customer');

           }



function GenPayInvo(Request $request,$invono){

$cuspaydata=Cus_phes::select()->where('invono',$invono)->get();

$paycusdata = Cus_pay::select('cusname')
    ->where('invono', $invono)
    ->first();
$totda = Cus_pay::select('totamount')
    ->where('invono', $invono)
    ->first();
    
return view('cuspayh',['cuspaydata'=>$cuspaydata,'paycusdata'=>$paycusdata,'invono'=>$invono,'totda'=>$totda]);
}
}
