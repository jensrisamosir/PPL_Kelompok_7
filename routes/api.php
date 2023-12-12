<?php

use App\Http\Controllers\Api\AsistenController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ObatController;
use App\Http\Controllers\Api\RekamMedisController;
use App\Http\Controllers\MedicalRecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('patient',[PatientController::class, 'index']);
Route::get('patient/{id}',[PatientController::class, 'show']);
Route::post('patient',[PatientController::class, 'store']);
Route::put('patient/{id}',[PatientController::class, 'update']);
Route::delete('patient/{id}',[PatientController::class, 'destroy']);

Route::get('obat/show',[ObatController::class, 'index']);
Route::get('obat/{id}',[ObatController::class, 'show']);
Route::post('obat',[ObatController::class, 'store']);
Route::put('obat/{id}',[ObatController::class, 'update']);
Route::delete('obat/{id}',[ObatController::class, 'destroy']);

Route::get('/showAkun',[AsistenController::class, 'index']);
Route::get('/getasisten/{id}',[AsistenController::class, 'show']);
Route::post('/createAsisten',[AsistenController::class, 'store']);
Route::delete('/deleteAkun/{id}',[AsistenController::class, 'destroy']);

Route::get('/add/view/',[RekamMedisController::class, 'index']);
Route::get('/show-user/{id}',[RekamMedisController::class, 'show']);
// Route::post('/medical/record',[RekamMedisController::class, 'store']);
Route::middleware('api')->post('/medical/record', [RekamMedisController::class, 'store']);
