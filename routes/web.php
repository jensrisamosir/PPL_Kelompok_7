<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AsistenController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CreateObatController;
use App\Http\Controllers\ShowPasienController;
use App\Http\Controllers\CreateAsistenController;
use App\Http\Controllers\CreatePatientController;
use App\Http\Controllers\MedicalRecordController;
use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;
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
    return view('auth.login');
});

//middleware role
//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'dologin']);

});

// untuk dokter dan asisten
Route::group(['middleware' => ['auth', 'checkrole:1,2']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);
});


// untuk dokter
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    Route::get('/dokter', [DokterController::class, 'index']);

        //createAsisten
    Route::get('/addAkun', function () {
        return view ('dokter.addAkun');
    });

    Route::get('/createAsisten', function () {
        return view ('dokter.create');
    });

    //menampilkan akun asisten
    Route::get('/showAkun', [AuthController::class, 'showAccount'])->name('showAkun');

    Route::get('/getasisten',[AsistenController::class, 'show']);

    //menghapus akun asisten

    Route::delete('/deleteAkun{id}', [AuthController::class, 'destroy'])->name('deleteAkun');


    Route::post('/createAsisten', [CreateAsistenController::class, 'store'])->name('asisten.create');

    Route::get('/patients/show/dokter',[ShowPasienController::class, 'show'])->name('patients.show.dokter');

    Route::get('/obat/show/dokter',[ShowPasienController::class, 'show2'])->name('obat.show.dokter');

    Route::get('/Medical/show',[MedicalRecordController::class, 'show'])->name('medical.show');

    Route::get('/show-user/{id}',[MedicalRecordController::class, 'button'])->name('show.patient');

    Route::put('/pasien/edit/{patient}', [ShowPasienController::class,'update'])->name('dokter.patients.update');

    Route::get('/pasien/redirect{patient}',[ShowPasienController::class, 'edit'])->name('dokter.patients.edit');

    Route::delete('/deletePatient{id}', [ShowPasienController::class, 'gone'])->name('dokter.delete.pasien');

        //medicalRecord

    Route::get('/index/pasien/{id}',[MedicalRecordController::class, 'getID'])->name('index.pasien.form');

    Route::get('/add/view/',[MedicalRecordController::class, 'index'])->name('mRecord.create.view');

    Route::post('/medical/record',[MedicalRecordController::class,'store'])->name('mRecord.store');

    Route::get('/form/medical',[MedicalRecordController::class,'index2'])->name('FormMedical');
});

// untuk asisten
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/asisten', [AsistenController::class, 'index']);

        //pasien
    Route::get('/patients/create',[CreatePatientController::class, 'create'])->name('patients.create');

    Route::post('patients',[CreatePatientController::class,'store'])->name('patients.store');

    Route::get('/patients/show',[CreatePatientController::class, 'show'])->name('patients.show');

    Route::delete('/deletePasien{id}', [CreatePatientController::class, 'gone'])->name('delete.pasien');

    Route::get('/patients/edit/{id}', [CreatePatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/edit/{id}', [CreatePatientController::class, 'update'])->name('patients.update');

        //obat

    Route::get('/obat/create',[CreateObatController::class, 'index'])->name('obat.create');

    Route::post('/obat',[CreateObatController::class,'store'])->name('obat.store');

    Route::get('/obat/show',[CreateObatController::class, 'show'])->name('obat.show');

    Route::delete('/obat/{id}', [CreateObatController::class, 'destroy'])->name('delete.obat');

    Route::get('/obats/redirect/{obat}',[CreateObatController::class, 'edit'])->name('obat.edit');

    Route::put('/obats/edit/{obat}', [CreateObatController::class,'update'])->name('obat.update');

});

//forgotPassword

//menampilkan view forgot password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

//reset password
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',

    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');




