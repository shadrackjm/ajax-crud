<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// create your route here..
Route::get('/display/cars',[CrudController::class,'showAllCars']);
Route::get('/add/cars',[CrudController::class,'addCar'])->name('addCar');
Route::get('/edit/car',[CrudController::class,'editCar'])->name('editCar');
Route::get('delete/car/{id}',[CrudController::class,'deleteCar'])->name('deleteCar');

























// Route::get('/pagination/page',[CrudController::class,'loadPaginatedData']);
