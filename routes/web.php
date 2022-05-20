<?php

use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SensorController;
use App\Http\Livewire\Admin\Dashboard;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/', Dashboard::class)->name('principal');

    Route::get('persons', [PersonController::class, 'index'])->name('persons.index');
    Route::get('produccion', [ProductController::class, 'index'])->name('productos.index');
    Route::get('sensores', [SensorController::class, 'index'])->name('sensores.index');
    Route::post('sensor/humedad/all', [SensorController::class, 'humedad_all'])->name('sensores.humedad');
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
