<?php

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DrawController;
use App\Http\Controllers\DrawWinnerController;
use App\Http\Controllers\DrawManagementController;
use App\Http\Controllers\ParticipantsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('participants/index',[ParticipantsController::class,'index']);

//grand winner
Route::get('grand/winner',[DrawController::class,'grandWinner']);

Route::get('export/winner/{draw}',[DrawWinnerController::class,'exportWinners']);
Route::post('winner/store',[DrawWinnerController::class,'saveWinner']);
Route::post('winner/disqualify',[DrawWinnerController::class,'disqualify']);
Route::post('grand_winner/disqualify',[DrawWinnerController::class,'grand_winner_disqualify']);

Route::post('draw/discard',[DrawManagementController::class,'discardAndCreate']);
Route::post('draw/complete/{draw}',[DrawManagementController::class,'completeDraw']);
Route::post('draw/start',[DrawManagementController::class,'startDraw'])->name('start.draw');

Route::get('draw/index',[DrawController::class,'getDraws']);
Route::get('draw/winners',[DrawController::class,'getCurrentDrawWinners']);
Route::post('spin',[DrawController::class,'spin']);
Route::post('disqualify',[DrawController::class,'disqualify']);

Route::post('/participants/import', [App\Http\Controllers\ParticipantsController::class, 'importParticipants'])->name('participants.import');
