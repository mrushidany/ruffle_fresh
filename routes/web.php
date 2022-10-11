<?php

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\DrawController;
// use App\Http\Controllers\DrawController;

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

Route::get('/', function () {
    return view('landing_page');
})->name('landing_page');

Route::post('register',[AuthController::class,'register'])->name('user.register');

Auth::routes();

Route::middleware('web')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'draws'])->name('home');    
    Route::get('start/home', [App\Http\Controllers\HomeController::class, 'draw'])->name('home');    
    // Route::post('/participants/import', [App\Http\Controllers\ParticipantsController::class, 'importParticipants'])->name('participants.import');

    Route::post('/start/draw',[DrawController::class,'startDraw'])->name('start.draw');
    Route::get('/draws', [App\Http\Controllers\HomeController::class, 'draws'])->name('draws'); 
    Route::get('/draw/{period}/{draw_type}', [App\Http\Controllers\HomeController::class, 'drawMC'])->name('upload'); 
    Route::post('/upoload/file',[App\Http\Controllers\ParticipantsController::class,'importParticipants'])->name('upload.file');

    Route::post('/spin_draw',[App\Http\Controllers\DrawController::class,'spin_draw'])->name('spin_draw');

    Route::get('/delete_data/{draw_id}', [App\Http\Controllers\ParticipantsController::class, 'deleteData'])->name('delete_data'); 
    Route::get('/save_draw', [App\Http\Controllers\DrawController::class, 'saveDraw'])->name('save_draw'); 
    
    Route::get('discard_result/{draw_id}', [App\Http\Controllers\DrawController::class, 'discardResult'])->name('discard_result'); 
    
    Route::get('disqualify_winner/{winner_id}', [App\Http\Controllers\DrawController::class, 'disqualifyWinner'])->name('disqualify_winner'); 

    Route::post('send_email', [App\Http\Controllers\HomeController::class, 'sendEmail'])->name('send_email');
});
