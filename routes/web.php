<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
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

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['authcustom'])->group(function(){
    Route::get("/dashboard", [DashboardController::class, 'index'])->name('dashboard');
    Route::get("/user-login", [DashboardController::class, 'datatable'])->name('user-login.datatable');
    Route::get("/count-dashboard", [DashboardController::class, 'count_ajax'])->name('count.dashboard');
});

Route::prefix('admin')->middleware(['admin'])->group(function(){
    Route::resource('/unit', UnitController::class);
    Route::get('/unit-datatable', [UnitController::class, 'datatable'])->name('unit.datatable');

    Route::resource('/position', PositionController::class);
    Route::get('/position-datatable', [PositionController::class, 'datatable'])->name('position.datatable');

    Route::resource('/pegawai', EmployeeController::class);
    Route::get('/pegawai-datatable', [EmployeeController::class, 'datatable'])->name('pegawai.datatable');
    Route::get('/search-unit', [EmployeeController::class, 'search_unit'])->name('search.unit');
    Route::get('/search-position', [EmployeeController::class, 'search_position'])->name('search.position');
});