<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
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

Route::get('addCategory',function(){
    return view('addCategory');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});

Route::get('category',[CategoryController::class, 'index'])->name('AllCategory');
Route::post('insertCategory',[CategoryController::class, 'store']);

Route::get('/editCategory/{id}',[CategoryController::class,'edit']);
Route::post('editCategory/update/{id}',[CategoryController::class, 'update']);

Route::get('/editCategory/delete/{id}',[CategoryController::class,'delete']);