<?php

use Inertia\Inertia;
use App\Role;
use App\Kelas;
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
    $userRole = Role::where('id', $user->role_id)->first();
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    return Inertia::render('Asisten', [
        'comingFrom' => $comingFrom,
        'currentUser' => $user,
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

Route::get('/logoutAsisten', 'Auth\AsistenLoginController@logout')->name('logoutAsisten');
Route::get('/logoutPraktikan', 'Auth\PraktikanLoginController@logout')->name('logoutAsisten');

Route::post('/signupAsisten', 'AsistenController@store')->name('signupAsisten');
Route::post('/signupPraktikan', 'PraktikanController@store')->name('signupPraktikan');
Route::post('/loginPraktikan', 'Auth\PraktikanLoginController@login')->name('loginPraktikan');
Route::post('/loginAsisten', 'Auth\AsistenLoginController@login')->name('loginAsisten');
