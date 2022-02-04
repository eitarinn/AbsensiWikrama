<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\dashboardAdminController;
use App\Http\Controllers\dashboardStudentController;
use App\Http\Controllers\PresentController;
use App\Http\Controllers\AbsentController;
use App\Http\Controllers\PresensiController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/asAdmin', [dashboardAdminController::class, 'index'])->middleware('auth');
Route::get('/asStudent', [dashboardStudentController::class, 'index'])->middleware('auth');

Route::resource('rayons', RayonController::class)->middleware('auth');
Route::resource('rombels', RombelController::class)->middleware('auth');
Route::resource('students', StudentController::class)->middleware('auth');
Route::resource('admins', AdminController::class)->middleware('auth');
Route::resource('presents', PresentController::class)->middleware('auth');
Route::resource('absents', AbsentController::class)->middleware('auth');
Route::resource('presensis', PresensiController::class)->middleware('auth');
