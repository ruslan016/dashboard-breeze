<?php

use App\Http\Middleware\IsraelOnly;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

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

Route::middleware(['IsraelOnly'])->group(function () {
    Route::redirect('/', 'login');
    Route::get('dashboard', [CountryController::class, 'index']);
    Route::post('dashboard', [CountryController::class, 'store']);
    Route::get('fetch-countries', [CountryController::class, 'show']);
    Route::get('edit-country/{id}', [CountryController::class, 'edit']);
    Route::put('update-country/{id}', [CountryController::class, 'update']);
});

Route::get('/dashboard', function () {
    return view('dashboard',);
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
