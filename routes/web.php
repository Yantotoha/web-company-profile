<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function(){
    Route::controller(HomeController::class)->group(function(){
        Route::get('/','index')->name('admin.home');
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
