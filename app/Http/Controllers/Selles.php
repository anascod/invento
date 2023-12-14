<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Models\Sellesmod;
use App\Models\Sell_pro;
use App\Models\sellhes;
use App\Models\Customermod;
use App\Models\Productmod;
use App\Models\Cus_pay;
use App\Models\Cus_phes;
use Redirect;
use DB;
use TCPDF;
use Session;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;


class Selles extends Controller
{


    public function index(Request $request)
    {


        return view('selles');
    }


    function generateInvoiceNumber()
    {
        $currentYear = Carbon::now()->format('Y');
        $uniqueId = uniqid();

        return 'INV-' . $currentYear . '-' . $uniqueId;
    }



    function StoreDat(Request $request)
    {
        Session::forget('custname');

// Validate the input data (optional but recommended)
        $invoiceNumber = Selles::generateInvoiceNumber();

        $validatedData = $request->validate([
            'custname' => 'required|string|max:255',
        ]);

// Store the input data in the session (if needed)
        $request->session()->put('input_data', $validatedData);

        $request->session()->put('invo', $invoiceNumber);

// Store the input data in the session.

// Redirect back or to a different page after successful storage
        return Redirect::to('/selles');
    }


    function InsertSel(Request $request,$id)
    {
// $invonumber=Selles::generateInvoiceNumber();
        $invonumber=0;

        $addsel = Productmod::find($id);
        $custuu =  $request->input('custname');

        $multi=$addsel->proprice*$request->proquan;

        if (is_null(session('input_data'))&&is_null(session('invo'))) {
            Alert::warning('خطاء', '<H4>يجب اختيار العميل</H4>')->toHtml();
            return Redirect::to('/selles');

        }else{ 
            $invono=Sell_pro::create([
                'invono'=> session()->get('invo'),
                'proname'=> $addsel->proname,
                'proquan'=> $request->proquan,
                'total'=> $multi,
                'prounite'=> $addsel->prounite,
                'custname'=> session()->get('input_data')['custname'],
            ]);
//         $suplar= DB::table('product')
// ->where('proname',$addsel->proname)
// ->where('prounite',$addsel->prounite)
// ->decrement('proquan', $request->proquan  );


            return Redirect::to('/selles');
        }
    }


    function ShowSelData()
    {



        $sells = DB::select('select * from sell_pro');
        $additio=Sell_pro::sum('total');
        $Productfatch = Productmod::all();
        $custtfatch = Customermod::all();
        $pro=array('cus'=>$Productfatch);
        $prouni= array('sells'=>$sells);
        $umsa= array('additio'=>$additio);
        $custome= array('custtfatch'=>$custtfatch);
        $all_r=Arr::collapse([$pro,$prouni,$custome,$umsa]);
        return view('selles',$all_r);

    }


    function DeletSelData($id)
    {
        // $invrec=DB::select('select* from sell_pro where id = ?',[$id]);
        // foreach($invrec as $inver){
        //     $suplar= DB::table('product')
        //     ->where('proname',$inver->proname)
        //     ->where('prounite',$inver->prounite)
        //     ->increment('proquan', $inver->proquan  );
// echo  $inver->proquan ;
        // }
        DB::delete('delete from sell_pro where id = ?',[$id]);

        return Redirect::to('/selles');

    }


    function  ConcatData(Request  $request )
    {
        $sellpro = Sell_pro::select(
            DB::raw("CONCAT(proname,' ') as pronuname"),
            DB::raw("CONCAT(proquan ,' ') as proquan"),
            DB::raw("invono  as proinv"),
            DB::raw("CONCAT(prounite ,' ') as proune"),
            DB::raw("CONCAT(total ,' ') as ptototal"),
        )->where("invono",session()->get('invo'))
        ->get();

        $additio=Sell_pro::sum('total');
        $mergedpronae = [];
        $mergedproquan = [];
        $mergedinvo = [];
        $mergedune = [];
        $mergedtotal = [];

        foreach ($sellpro as $val)  {
            $mergedpronae[] = $val->pronuname;
            $mergedproquan[] = $val->proquan;
            $mergedinvo[] = $val->proinv;
            $mergedune[] = $val->proune;
            $mergedtotal[] = $val->ptototal;

        }
        $oroname =implode(', ', $mergedpronae);
        $quant= implode(', ', $mergedproquan);
        $invo= implode(', ', $mergedinvo);
        $unn= implode(', ', $mergedune);
        $tot= implode(', ', $mergedtotal);
        $chsee=DB::table('sellhes')->where('invono',session()->get('invo'))->get();


        if (is_null(session('input_data'))&&is_null(session('invo'))) {
            Alert::warning('خطاء', '<H4>يجب اختيار العميل</H4>')->toHtml();
            return Redirect::to('/selles');

        } 
        if ($chsee->count() > 0) {
            Alert::warning('خطاء', '<H4>تم اصدار فاتورة مسبقا</H4>')->toHtml();
            return Redirect::to('/selles');
        }
        if(empty($oroname )||empty($unn)||empty($quant)){
            Alert::warning('خطاء', '<H4>لا يمكن اصدار فاتورة لايوجد اصناف </H4>')->toHtml();
            return Redirect::to('/selles');

        }
        else{ 

         

        $checktot=Sell_pro::where("invono",session()->get('invo'))->sum('total');


         $amount = $request->cuspayam;
        $amount = empty($amount) ? 0 : $amount;
            // $sumarr=array_sum($totalValues);
            $reminamo=  $checktot-$amount;
if ($request->cuspayam >= $checktot) {
Alert::warning('خطاء', '<H4>لا يمكن ان تكون الدفعة الاولة اكبر من الاجمالي</H4>')->toHtml();
        return Redirect::to('/selles');

            }

 if (!empty($amount)) {
            $post = new Cus_pay;

            $post->cusname = session()->get('input_data')['custname'];
            $post->totamount = $checktot;
            $post->reminam = $reminamo;
            $post->invono =  session()->get('invo');
            $post->firstpay =  $request->cuspayam;
            $post->save();

            $phes= new Cus_phes;
            $phes->invono=session()->get('invo');
            $phes->totamount = $checktot;
            $phes->payment = $request->cuspayam;
            $phes->reminam = $reminamo;
            $phes->save();

        }
   $inserting=Sellhes::create([
                'invono'=> session()->get('invo'),
                'proname'=> $oroname,
                'proquan'=> $quant,
                'total'=> $tot,
                'prounite'=> $unn,
                'custname'=> session()->get('input_data')['custname'],
            ]);

            $sek=DB::table('sellhes')->get();
            $timeli=sellhes::select('created_at')->where('invono',session()->get('invo'))->get();

$timestamp = $timeli[0]->my_timestamp_field;
$formatted_date = date('Y-m-d', $timestamp);

            $data = json_decode($sek, true, JSON_UNESCAPED_UNICODE);
            $newq=sellhes::select()->where('invono', session()->get('invo'))->get();


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
                    ->decrement('proquan', intval($proquanValues[$key]));
                }

            }


           


            $cuspay=$request->cuspayam;
            $custnam=session()->get('input_data')['custname'];
            $invo= session()->get('invo');

            $dataes = [
                'data' => $data,
                'invo' => $invo,
            ];
        $prodat= array('data'=>$data);
        $proin= array('invo'=>$invo);
        $procus= array('custnam'=>$custnam);
        $propay= array('cuspay'=>$cuspay);
        // $sumarreew= array('sumarr'=>$sumarr);

        $all_r=Arr::collapse([$prodat,$proin,$procus,$propay]);
        DB::delete('delete from sell_pro where invono = ?',[session()->get('invo')]);

            return view('invoice', ['data'=>$data,'invo'=>$invo,'custnam'=>$custnam,'cuspay'=>$cuspay,'formatted_date'=>$formatted_date]);
// return redirect('/selles'); // Redirect the user to '/selles' after rendering the 'invoice' view


        }

    }


}
