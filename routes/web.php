<?php

use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CasheerController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckUserLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('login');
});

Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah']);
Route::get('kurang', [BelajarController::class, 'kurang']);

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('action-login', [LoginController::class, 'actionLogin']);

Route::post('actionTambah', [BelajarController::class, 'actionTambah']);
Route::post('actionKurang', [BelajarController::class, 'actionKurang']);

// Route::resource('dashboard', DashboardController::class);

Route::middleware([CheckUserLogin::class])->group(function() {
    Route::resource('categories', CategoriesController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('products', ProductController::class);
    Route::resource('pos', TransactionController::class);
    Route::resource('users', controller: UserController::class);
    Route::resource('analytic', controller: AnalyticController::class);

    Route::get('casheer', [CasheerController::class, 'index'])->name('casheer.index');
})->withoutMiddleware([CheckUserLogin::class]);


Route::get('get-product/{id}', [TransactionController::class, 'getProduct']);
Route::get('/product/get-all', [ProductController::class, 'getProduct']);
Route::get('/analyze/getwidget' , [AnalyticController::class , 'getwidget']);


// Route::resource('users', controller: UserController::class);
route::get('logout', [LoginController::class, 'logout']);


route::get('print/{id}', [TransactionController::class, 'print'])->name('print');

