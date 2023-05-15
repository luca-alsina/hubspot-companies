<?php

use App\Contracts\HubspotServiceInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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

Route::redirect( '/', '/companies' );

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(static function () {

    Route::group([ 'prefix' => 'companies', 'as' => 'companies.'], static function () {
        Route::get('/', [ \App\Http\Controllers\CompanyController::class, 'index' ])->name('index');

        Route::group([ 'prefix' => 'industries', 'as' => 'industries.'], static function () {
//            Route::get('/', [ \App\Http\Controllers\CompanyController::class, 'industries' ])->name('index');
            Route::get('/{industry}', [ \App\Http\Controllers\CompanyController::class, 'searchByIndustry' ])->name('search');
        });
        Route::get('/{company}', [ \App\Http\Controllers\CompanyController::class, 'show' ])->name('show');
    });

});
