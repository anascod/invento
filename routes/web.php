<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Product;
use App\Http\Controllers\invoice;
use App\Http\Controllers\Invoices;
use App\Http\Controllers\Unvoices;
use App\Http\Controllers\Supply;
use App\Http\Controllers\Selles;
use App\Http\Controllers\Purchase;
use App\Http\Controllers\Unit;
use App\Http\Controllers\Customer;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/dashboard', function () {
    return view('dashboard');
});

   

    Route::get('invoice', [DashboardController::class,'invo' ])->name('invoice.invo');
    // Route::get('dashboard', [DashboardController::class,'dash' ])->name('dashboard.dash');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ////////supplyer
    Route::patch('supply',[  Supply::class,'index'])->name('supply.index');
    Route::get('/supply', [Supply::class, 'ShowData'])->name('supply.ShowData');
    Route::get('/supply/{id}',[Supply::class,'DeletData'])->name('supply.DeletData');
    Route::post('/SuppEdit/{id}', [Supply::class, 'SuppEdit']);
    Route::post('InsertSupp',[Supply::class,'InsertSupp']);
    Route::post('Paysup/{id}',[Supply::class,'Paysup']);

///////customer
    Route::patch('customer',[  Customer::class,'index'])->name('customer.index');
    Route::get('/customer', [Customer::class, 'ShowCusData'])->name('customer.ShowCusData');
    Route::get('/customer/{id}',[Customer::class,'DeletCusData'])->name('customer.DeletCusData');
    Route::post('/CusEdit/{id}', [Customer::class, 'CusEdit']);
    Route::post('InsertCus',[Customer::class,'InsertCus']);
    Route::post('Cuspay/{id}',[Customer::class,'Cuspay']);
    Route::get('GenPayInvo/{invono}',[Customer::class,'GenPayInvo'])->name('GenPayInvo');

    // Route::get('/validation','ValidationController@showform');

/////product
    Route::get('/product', [Product::class, 'index'])->name('product.index');
    Route::get('/product', [Product::class, 'ShowProData'])->name('product.ShowProData');
    Route::get('/product/{id}',[Product::class,'DeletProData'])->name('product.DeletProData');
    Route::post('/ProEdit/{id}', [Product::class, 'ProEdit']);
    Route::post('InsertPro',[Product::class,'InsertPro']);

    /////selles
    Route::get('/selles', [Selles::class, 'index'])->name('selles.index');
    Route::get('/selles', [Selles::class, 'ShowSelData'])->name('selles.ShowSelData');
    Route::get('/selles/{id}',[Selles::class,'DeletSelData'])->name('selles.DeletSelData');
    Route::post('/SelEdit/{id}', [Selles::class, 'SelEdit']);
    Route::get('InsertSel/{id}',[Selles::class,'InsertSel']);
    Route::post('/ConcatData', [Selles::class, 'ConcatData'])->name('selles.ConcatData');
    Route::post('/StoreDat', [Selles::class, 'StoreDat'])->name('selles.StoreDat');
    Route::get('/PrintPdf', [Selles::class, 'PrintPdf'])->name('selles.PrintPdf');
    

 /////purchase/////
    Route::get('/purchase', [Purchase::class, 'Purindex'])->name('purchase.Purindex');
    Route::get('/purchase', [Purchase::class, 'ShowPurData'])->name('purchase.ShowPurData');
    Route::get('/purchase/{id}',[Purchase::class,'DeletPurData'])->name('purchase.DeletPurData');
    Route::post('/PurEdit/{id}', [Purchase::class, 'PurEdit'])->name('purchase.PurEdit');
    Route::post('/InsertPur',[Purchase::class,'InsertPur']);
    

//////UNIT/////////
    Route::get('/unit', [Unit::class, 'Unitindex'])->name('unit.Unitindex');
    Route::get('/unit', [Unit::class, 'ShowUniData'])->name('unit.ShowUniData');
    Route::get('/unit/{id}',[Unit::class,'DeletUniData'])->name('unit.DeletProData');
    Route::post('/UniEdit/{id}',[Unit::class, 'UniEdit']);
    Route::post('InsertUni',[Unit::class,'InsertUni']);

//////invoice 
    Route::get('/invoice', [invoice::class, 'Invindex'])->name('invoice.Invindex');
    Route::get('/invoice', [invoice::class, 'ShowInvoData'])->name('invoice.ShowInvoData');

//////InvoView
        Route::get('/invoices',  [Invoices::class, 'InvoView'])->name('invoices.InvoView');
        Route::get('/invoices',  [Invoices::class, 'ShowInvo'])->name('invoices.ShowInvo');
    Route::post('/EditInvo/{id}', [Invoices::class,'EditInvo'])->name('invoices.EditInvo');
    Route::get('/showinvoice/{invnum}', [Invoices::class,'showinvoice'])->name('invoices.showinvoice');
    Route::get('/DeletInvoices/{id}', [Invoices::class,'DeletInvoices'])->name('invoices.DeletInvoices');
    Route::post('/AddPro/{invoice}', [Invoices::class,'AddPro'])->name('invoices.AddPro');
Route::get('/Deletitem', [Invoices::class, 'Deletitem'])->name('invoices.Deletitem');



    Route::get('/', function () {
        return view('admin');
});


});

require __DIR__.'/auth.php';
