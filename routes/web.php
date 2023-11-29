<?php

use App\Http\Controllers\BasesalaryController;
use App\Http\Controllers\DownloaddbController;
use App\Http\Controllers\PunchController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('punch/create');
});

Route::get('users',[UsersController::class,'index'])->name('users.index');
Route::get('users/create',[UsersController::class,'create'])->name('users.create');
Route::post('users/store',[UsersController::class,'store'])->name('users.store');
Route::get('users/{id}/{role}/edit',[UsersController::class,'edit'])->where("id","[0-9]+")->name('users.edit');
Route::get('users/{id}/edit',[UsersController::class,'edituser'])->where("id","[0-9]+")->name('users.edituser');
Route::patch('users/update/{id}',[UsersController::class,'update'])->where("id","[0-9]+")->name('users.update');
Route::delete('users/delete/{id}',[UsersController::class,'destroy'])->where("id","[0-9]+")->name('users.destroy');


Route::get('punch',[PunchController::class,'index'])->name('punch.index');
Route::get('punch/record',[PunchController::class,'record'])->name('punch.record');
Route::get('punch/date/{date}',[PunchController::class,'date'])->name('punch.date');
Route::get('punch/{id}/edit/{state}',[PunchController::class,'edit'])->where("id","[0-9]+")->name('punch.edit');
Route::get('punch/{id}/{month}',[PunchController::class,'show'])->where("id","[0-9]+")->name('punch.show');
Route::patch('punch/update/{id}',[PunchController::class,'update'])->where("id","[0-9]+")->name('punch.update');
Route::get('punch/create',[PunchController::class,'create'])->name('punch.create');
Route::get('punch/createuserdata',[PunchController::class,'createuserdata'])->name('punch.createuserdata');
Route::get('punch/createuserdata/{id}',[PunchController::class,'createuserdata1'])->where("id","[0-9]+")->name('punch.createuserdata1');
Route::post('punch/store',[PunchController::class,'store'])->name('punch.store');
Route::post('punch/store2',[PunchController::class,'store2'])->name('punch.store2');
Route::post('punch/month', [PunchController::class,'month'])->name('punch.month');
Route::delete('punch/delete/{id}/{punchid}',[PunchController::class,'destroy'])->where("id","[0-9]+")->where("punchid","[0-9]+")->name('punch.destroy');

Route::patch('basesalary/update/{id}',[BasesalaryController::class,'update'])->where("id","[0-9]+")->name('basesalary.update');
Route::get('basesalary/{id}/edit',[BasesalaryController::class,'edit'])->where("id","[0-9]+")->name('basesalary.edit');

Route::get('downloaddb',[DownloaddbController::class,'download'])->name('downloaddb.download');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
