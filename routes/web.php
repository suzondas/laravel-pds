<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/user/pds', \App\Http\Livewire\Pds::class)->name('pds');
    Route::get('/settings/countries', \App\Http\Livewire\Countries::class)->name('countries');
    Route::get('/settings/degrees', \App\Http\Livewire\Degrees::class)->name('degrees');
    Route::get('/settings/designations', \App\Http\Livewire\Designations::class)->name('designations');
    Route::get('/settings/offices', \App\Http\Livewire\Offices::class)->name('offices');
//    Route::get('/settings/language', \App\Http\Livewire\Language_information::class)->name('language');
//    Route::get('/settings/educational_qualification', \App\Http\Livewire\Educational_qualification::class)->name('educational_qualification');
});
