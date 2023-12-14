<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productmod;
use Redirect;
use DB;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;

class Product extends Controller
{
    //





    
   public function index(Request $request){

       
    return view('product');
}


function InsertPro(Request $request)
{

   $check = Productmod::where('proname',$request->proname)
->where('prounite',$request->unitsele)
->get();

if($check->isEmpty()){
    $post=Productmod::create([
        'proname'=> $request->proname,
        'prounite'=> $request->unitsele,
        'proprice'=> $request->proprice,
    ]);

 Alert::success('<H3>تم  الاضافة بنجاح  </H3>', '')->toHtml();
    return Redirect::to('/product');

}else{
    
Alert::warning('خطاء', '<H4> الصنف و الوحدة مضافة مسبقا</H4>')->toHtml();
 return redirect()->to('/product');
}

}


function ShowProData()
{

  $cus = DB::select('select * from product');
  $units = DB::select('select * from pro_unit');
  $pro=array('cus'=>$cus);
  $prouni= array('units'=>$units);
  $all_r=Arr::collapse([$pro,$prouni]);
  return view('product',$all_r);

}


function DeletProData($id)
{
  DB::delete('delete from product where id = ?',[$id]);
   Alert::success('<H3>تم الحذف بنجاح  </H3>', '')->toHtml();

  return Redirect::to('/product');

}

function ProEdit(Request $request,$id) 
{
//      $check = Productmod::where('proname',$request->proname)
// ->where('prounite', $request->unitsele)
// ->get();

// if($check->isEmpty()){


 $update = Productmod::find($id);
 $update->proname = $request->proname;
 $update->prounite = $request->unitsele;
 $update->proprice = $request->proprice;
 $update->save();

Alert::success('<H3>تم  التعديل بنجاح  </H3>', '')->toHtml();
 return Redirect::to('/product');
// }else{
        Alert::warning('خطاء', '<H4> الصنف و الوحدة مضافة مسبقا</H4>')->toHtml();
 return redirect()->to('/product');
// }

}





}


