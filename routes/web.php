<?php

use Inertia\Inertia;
use App\Role;
use App\Kelas;
use App\Feedback;
use App\Modul;
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
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    return Inertia::render('Welcome', [
        'comingFrom' => $comingFrom
    ]);
})->middleware('guest:all');

Route::get('/about', function () {
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    return Inertia::render('About', [
        'comingFrom' => $comingFrom
    ]);
})->middleware('guest:all');

Route::get('/contact', function () {
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    return Inertia::render('Contact', [
        'comingFrom' => $comingFrom
    ]);
})->middleware('guest:all');

Route::get('/login', function () {
    $all_kelas = Kelas::all();
    $roles = Role::all();
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
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
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    return Inertia::render('Asisten', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
        'messages' => $messages,
        'userRole' => $userRole->role,
    ]);
})->name('asisten')->middleware('loggedIn:all');

Route::get('/praktikan', function () {
    $user = Auth::guard('praktikan')->user();
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    return Inertia::render('Praktikan', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user
    ]);
})->name('praktikan')->middleware('loggedIn:all');

Route::get('/soal', function () {
    $user = Auth::guard('asisten')->user();
    $userRole = Role::where('id', $user->role_id)->first();
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    $position = request('position') == null ? 0:request('position');
    return Inertia::render('Soal', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
        'position' => $position,
        'userRole' => $userRole->role,
    ]);
})->name('soal')->middleware('loggedIn:asisten');

Route::get('/kelas', function () {
    $user = Auth::guard('asisten')->user();
    $userRole = Role::where('id', $user->role_id)->first();
    $allKelas = Kelas::all();
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    $position = request('position') == null ? 0:request('position');
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
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    $position = request('position') == null ? 0:request('position');
    return Inertia::render('Modul', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
        'position' => $position,
        'userRole' => $userRole->role,
        'allModul' => $allModul,
    ]);
})->name('modul')->middleware('loggedIn:asisten');

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
