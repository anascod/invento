<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unitmod;
use Redirect;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class Unit extends Controller
{



 public function Unitindex(Request $request)
{


    return view('unit');
}


function InsertUni(Request $request)
{
 $check = Unitmod::where('unitname',$request->proname)->get();


if($check->isEmpty()){
   

 $post=Unitmod::create([
        'unitname'=> $request->proname,
    ]);

 Alert::success('<H3>تم  الاضافة بنجاح  </H3>', '')->toHtml();
 return Redirect::to('/unit');

}else{ 

Alert::warning('خطاء', '<H4>الوحدة مضافة </H4>')->toHtml();
return redirect()->to('/unit');
}

}
function ShowUniData()
{

  $cus = DB::table('pro_unit')->get();

  // $cus = DB::select('select * from product');
  return view('/unit',['cus'=>$cus]);

}


function DeletUniData($id)
{
  DB::delete('delete from pro_unit where id = ?',[$id]);
   Alert::success('<H3>تم الحذف بنجاح  </H3>', '')->toHtml();

  return Redirect::to('/unit');

}

function UniEdit(Request $request,$id) 
{
 $check = Unitmod::where('unitname',$request->proname)->get();


if($check->isEmpty()){
   

   $update = Unitmod::find($id);
   $update->unitname = $request->proname;

   $update->save();
Alert::success('<H3>تم التعديل بنجاح  </H3>', '')->toHtml();

   return Redirect::to('/unit');

}else{ 

Alert::warning('خطاء', '<H4>الوحدة مضافة </H4>')->toHtml();
return redirect()->to('/unit');
}
}


}
