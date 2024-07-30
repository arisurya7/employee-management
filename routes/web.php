<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UnitController;
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
    return redirect('admin/dashboard');
});


Route::prefix('admin')->group(function(){
    Route::get("/dashboard", [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('/unit', UnitController::class);
    Route::get('/unit-datatable', [UnitController::class, 'datatable'])->name('unit.datatable');

    Route::resource('/position', PositionController::class);
    Route::get('/position-datatable', [PositionController::class, 'datatable'])->name('position.datatable');

});