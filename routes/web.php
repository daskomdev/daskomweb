<?php

use Inertia\Inertia;
use App\Role;
use App\Kelas;
use App\Feedback;
use App\Modul;
use App\Jadwal_Jaga;
use App\Asisten;

use Illuminate\Support\Facades\Auth;
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
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    return Inertia::render('Welcome', [
        'comingFrom' => $comingFrom
    ]);
})->middleware('guest:all');

Route::get('/about', function () {
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    return Inertia::render('About', [
        'comingFrom' => $comingFrom
    ]);
})->middleware('guest:all');

Route::get('/contact', function () {
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    return Inertia::render('Contact', [
        'comingFrom' => $comingFrom
    ]);
})->middleware('guest:all');

Route::get('/login', function () {
    $all_kelas = Kelas::all();
    $roles = Role::all();
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    return Inertia::render('Login', [
        'comingFrom' => $comingFrom,
        'all_kelas' => $all_kelas,
        'roles' => $roles
    ]);
})->name('login')->middleware('guest:all');

Route::get('/asisten', function () {
    $user = Auth::guard('asisten')->user();
    $messages = Feedback::where('asisten_id', $user->id)
                    ->leftJoin('kelas', 'feedback.kelas_id', '=', 'kelas.id')
                    ->leftJoin('praktikans', 'feedback.praktikan_id', '=', 'praktikans.id')
                    ->orderBy('feedback.created_at', 'desc')->get();
    $userRole = Role::where('id', $user->role_id)->first();
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    return Inertia::render('Asisten', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
        'messages' => $messages,
        'userRole' => $userRole->role,
    ]);
})->name('asisten')->middleware('loggedIn:asisten');

Route::get('/praktikan', function () {
    $user = Auth::guard('praktikan')->user();
    $user->kelas = Kelas::where('id', $user->kelas_id)->first()->kelas;
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    return Inertia::render('Praktikan', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user
    ]);
})->name('praktikan')->middleware('loggedIn:praktikan');

Route::get('/soal', function () {
    $user = Auth::guard('asisten')->user();
    $userRole = Role::where('id', $user->role_id)->first();
    $allModul = Modul::all();
    $allTP = DB::table('soal__tps')
            ->join('moduls', 'soal__tps.modul_id', '=', 'moduls.id')
            ->select('soal__tps.*', 'moduls.judul')->get();
    $allTA = DB::table('soal__tas')
            ->join('moduls', 'soal__tas.modul_id', '=', 'moduls.id')
            ->select('soal__tas.*', 'moduls.judul')->get();
    $allTK = DB::table('soal__tks')
            ->join('moduls', 'soal__tks.modul_id', '=', 'moduls.id')
            ->select('soal__tks.*', 'moduls.judul')->get();
    $allJurnal = DB::table('soal__jurnals')
            ->join('moduls', 'soal__jurnals.modul_id', '=', 'moduls.id')
            ->select('soal__jurnals.*', 'moduls.judul')->get();
    $allMandiri = DB::table('soal__mandiris')
            ->join('moduls', 'soal__mandiris.modul_id', '=', 'moduls.id')
            ->select('soal__mandiris.*', 'moduls.judul')->get();
    $allFITB = DB::table('soal__fitbs')
            ->join('moduls', 'soal__fitbs.modul_id', '=', 'moduls.id')
            ->select('soal__fitbs.*', 'moduls.judul')->get();

    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    $position = request('position') === null ? 0:request('position');
    return Inertia::render('Soal', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
        'position' => $position,
        'userRole' => $userRole->role,
        'allModul' => $allModul,

        'allTP' => $allTP,
        'allTA' => $allTA,
        'allTK' => $allTK,
        'allJurnal' => $allJurnal,
        'allMandiri' => $allMandiri,
        'allFITB' => $allFITB,
    ]);
})->name('soal')->middleware('loggedIn:asisten');

Route::get('/kelas', function () {
    $user = Auth::guard('asisten')->user();
    $userRole = Role::where('id', $user->role_id)->first();
    $allKelas = Kelas::all();
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    $position = request('position') === null ? 0:request('position');
    return Inertia::render('Kelas', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
        'position' => $position,
        'userRole' => $userRole->role,
        'allKelas' => $allKelas,
    ]);
})->name('kelas')->middleware('loggedIn:asisten');

Route::get('/modul', function () {
    $user = Auth::guard('asisten')->user();
    $userRole = Role::where('id', $user->role_id)->first();
    $allModul = Modul::all();
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    $position = request('position') === null ? 0:request('position');
    return Inertia::render('Modul', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
        'position' => $position,
        'userRole' => $userRole->role,
        'allModul' => $allModul,
    ]);
})->name('modul')->middleware('loggedIn:asisten');

Route::get('/plotting', function () {
    $user = Auth::guard('asisten')->user();
    $userRole = Role::where('id', $user->role_id)->first();
    $allJaga = DB::table('jadwal__jagas')
            ->join('asistens', 'jadwal__jagas.asisten_id', '=', 'asistens.id')
            ->join('kelas', 'jadwal__jagas.kelas_id', '=', 'kelas.id')
            ->select('jadwal__jagas.*', 'asistens.kode', 'kelas.kelas', 'kelas.hari', 'kelas.shift')->get();
    $allKelas = Kelas::all();
    $allAsisten = Asisten::all();
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    $position = request('position') === null ? 0:request('position');
    return Inertia::render('Plotting', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
        'position' => $position,
        'userRole' => $userRole->role,
        'allJaga' => $allJaga,
        'allKelas' => $allKelas,
        'allAsisten' => $allAsisten,
    ]);
})->name('plotting')->middleware('loggedIn:asisten');

Route::get('/praktikum', function () {
    $user = Auth::guard('asisten')->user();
    $userRole = Role::where('id', $user->role_id)->first();
    $allKelas = Kelas::all();
    $allModul = Modul::all();
    $comingFrom = request('comingFrom') === null ? 'none':request('comingFrom');
    $position = request('position') === null ? 0:request('position');
    return Inertia::render('Praktikum', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
        'position' => $position,
        'userRole' => $userRole->role,
        'allKelas' => $allKelas,
        'allModul' => $allModul,
    ]);
})->name('praktikum')->middleware('loggedIn:asisten');

Route::get('/logoutAsisten', 'Auth\AsistenLoginController@logout')->name('logoutAsisten');
Route::get('/logoutPraktikan', 'Auth\PraktikanLoginController@logout')->name('logoutAsisten');

Route::post('/signupAsisten', 'AsistenController@store')->name('signupAsisten');
Route::post('/signupPraktikan', 'PraktikanController@store')->name('signupPraktikan');
Route::post('/loginPraktikan', 'Auth\PraktikanLoginController@login')->name('loginPraktikan');
Route::post('/loginAsisten', 'Auth\AsistenLoginController@login')->name('loginAsisten');

Route::post('/sendPesan', 'FeedbackController@store')->name('sendPesan')->middleware('loggedIn:praktikan');
Route::post('/readPesan', 'FeedbackController@index')->name('readPesan')->middleware('loggedIn:asisten');

Route::post('/createKelas', 'KelasController@store')->name('createPesan')->middleware('loggedIn:asisten');
Route::post('/deleteKelas', 'KelasController@destroy')->name('deletePesan')->middleware('loggedIn:asisten');
Route::post('/updateKelas', 'KelasController@update')->name('updatePesan')->middleware('loggedIn:asisten');

Route::post('/createModul', 'ModulController@store')->name('createModul')->middleware('loggedIn:asisten');
Route::post('/deleteModul/{id}', 'ModulController@destroy')->name('deleteModul')->middleware('loggedIn:asisten');
Route::post('/updateModul', 'ModulController@update')->name('updateModul')->middleware('loggedIn:asisten');
Route::post('/readModul', 'ModulController@show')->name('readModul')->middleware('loggedIn:asisten');
Route::post('/getModul/{id}', 'ModulController@index')->name('getModul')->middleware('loggedIn:asisten');

Route::post('/createTP', 'SoalTpController@store')->name('createTP')->middleware('loggedIn:asisten');
Route::post('/deleteTP/{id}', 'SoalTpController@destroy')->name('deleteTP')->middleware('loggedIn:asisten');
Route::post('/updateTP', 'SoalTpController@update')->name('updateTP')->middleware('loggedIn:asisten');

Route::post('/createTA', 'SoalTaController@store')->name('createTA')->middleware('loggedIn:asisten');
Route::post('/deleteTA/{id}', 'SoalTaController@destroy')->name('deleteTA')->middleware('loggedIn:asisten');
Route::post('/updateTA', 'SoalTaController@update')->name('updateTA')->middleware('loggedIn:asisten');

Route::post('/createTK', 'SoalTkController@store')->name('createTK')->middleware('loggedIn:asisten');
Route::post('/deleteTK/{id}', 'SoalTkController@destroy')->name('deleteTK')->middleware('loggedIn:asisten');
Route::post('/updateTK', 'SoalTkController@update')->name('updateTK')->middleware('loggedIn:asisten');

Route::post('/createJurnal', 'SoalJurnalController@store')->name('createJurnal')->middleware('loggedIn:asisten');
Route::post('/deleteJurnal/{id}', 'SoalJurnalController@destroy')->name('deleteJurnal')->middleware('loggedIn:asisten');
Route::post('/updateJurnal', 'SoalJurnalController@update')->name('updateJurnal')->middleware('loggedIn:asisten');

Route::post('/createMandiri', 'SoalMandiriController@store')->name('createMandiri')->middleware('loggedIn:asisten');
Route::post('/deleteMandiri/{id}', 'SoalMandiriController@destroy')->name('deleteMandiri')->middleware('loggedIn:asisten');
Route::post('/updateMandiri', 'SoalMandiriController@update')->name('updateMandiri')->middleware('loggedIn:asisten');

Route::post('/createFitb', 'SoalFitbController@store')->name('createFitb')->middleware('loggedIn:asisten');
Route::post('/deleteFitb/{id}', 'SoalFitbController@destroy')->name('deleteFitb')->middleware('loggedIn:asisten');
Route::post('/updateFitb', 'SoalFitbController@update')->name('updateFitb')->middleware('loggedIn:asisten');

Route::post('/createJadwalJaga', 'JadwalJagaController@store')->name('createJadwalJaga')->middleware('loggedIn:asisten');
Route::post('/deleteJadwalJaga', 'JadwalJagaController@destroy')->name('deleteJadwalJaga')->middleware('loggedIn:asisten');

Route::post('/readDataKelas/{kelas_id}', 'KelasController@show')->name('updatePesan')->middleware('loggedIn:asisten');
Route::post('/cekPraktikum', 'PraktikumController@index')->name('cekPraktikum')->middleware('loggedIn:asisten');

Route::post('/createLaporanPJ', 'LaporanPjController@store')->name('createLaporanPJ')->middleware('loggedIn:asisten');
Route::post('/deleteLaporanPJ/{id}', 'LaporanPjController@destroy')->name('deleteLaporanPJ')->middleware('loggedIn:asisten');
Route::post('/updateLaporanPJ', 'LaporanPjController@update')->name('updateLaporanPJ')->middleware('loggedIn:asisten');
Route::post('/currentLaporanPJ', 'LaporanPjController@show')->name('currentLaporanPJ')->middleware('loggedIn:asisten');

Route::post('/startPraktikum', 'CurrentPraktikumController@store')->name('startPraktikum')->middleware('loggedIn:asisten');
Route::post('/continuePraktikum/{status}', 'CurrentPraktikumController@update')->name('continuePraktikum')->middleware('loggedIn:asisten');
Route::post('/stopPraktikum', 'CurrentPraktikumController@destroy')->name('stopPraktikum')->middleware('loggedIn:asisten');
Route::post('/checkPraktikum', 'CurrentPraktikumController@show')->name('checkPraktikum')->middleware('loggedIn:all');

Route::post('/makeHistory/jaga', 'HistoryJagaController@store')->name('createJagaHistory')->middleware('loggedIn:asisten');
Route::post('/deleteHistory/jaga', 'HistoryJagaController@destroy')->name('deleteJagaHistory')->middleware('loggedIn:asisten');
Route::post('/latestPJHistory/jaga', 'HistoryJagaController@show')->name('latestPJHistory')->middleware('loggedIn:asisten');

Route::post('/makeHistory/izin', 'HistoryIzinController@store')->name('createIzinHistory')->middleware('loggedIn:asisten');

Route::post('/createPraktikum', 'PraktikumController@store')->name('createPraktikum')->middleware('loggedIn:asisten');