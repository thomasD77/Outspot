<?php
use App\Http\Controllers\WebshopController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//General
Route::get('/', function () {
    return view('home');
});

//Webshop
Route::controller(WebshopController::class)->group(function(){
    Route::get('/payment', 'createPayment')->name('/payment');
    Route::get('/payment/return', 'catchReturn')->name('payment.return');
    Route::post('/payment/webhook', 'mollieWebhook')->name('payment.webhook');
});

