<?php

use Inertia\Inertia;

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
    return Inertia::render('Welcome')
        ->with('foo', 'welcome');
});

Route::get('/about', function () {
    return Inertia::render('About')
        ->with('foo', 'about');
});

Route::get('/contact', function () {
    return Inertia::render('Contact')
        ->with('foo', 'contact');
});
