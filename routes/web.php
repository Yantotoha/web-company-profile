<?php

use App\Http\Controllers\admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Routing\RouteGroup;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->middleware('guest')->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/auth','authenticate')->name('login.auth');
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::post('logout','logout')->name('logout');
    });
    Route::controller(HomeController::class)->group(function(){
        Route::get('/','index')->name('admin.index');
    });
    Route::controller (UserController::class)->group (function(){
        Route::get('/users', 'index')->name('admin.users');
        Route::get('/users/data', 'getData')->name('admin.users.data');
        Route::post('/users/store', 'storeData')->name('admin.users.store'); 
        Route::get('/users/detail', 'detail')->name('admin.users.detail');
        Route::post('/users/update', 'updateData')->name('admin.users.update'); 
        Route::delete('/users/delete', 'deleteData')->name('admin.users.delete');
    });
});
