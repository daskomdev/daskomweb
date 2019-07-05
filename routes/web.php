<?php

use Inertia\Inertia;
use App\Role;
use App\Kelas;
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
});

Route::get('/about', function () {
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    return Inertia::render('About', [
        'comingFrom' => $comingFrom
    ]);
});

Route::get('/contact', function () {
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    return Inertia::render('Contact', [
        'comingFrom' => $comingFrom
    ]);
});

Route::get('/login', function () {
    $all_kelas = Kelas::all();
    $roles = Role::all();
    $comingFrom = request('comingFrom') == null ? 'none':request('comingFrom');
    return Inertia::render('Login', [
        'comingFrom' => $comingFrom,
        'all_kelas' => $all_kelas,
        'roles' => $roles
    ]);
})->name('login');

Route::post('/signupAsisten', 'AsistenController@store')->name('signupAsisten');
