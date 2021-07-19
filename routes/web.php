<?php

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin'],function(){
    Auth::routes([
        'register' => false
    ]);

});

Route::group(['prefix' => 'admin','middleware' => 'ensureIsAdmin'],function(){
    Route::get('home',[HomeController::class,'index'])->name('home');
    Route::resource('posts',PostController::class);
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
