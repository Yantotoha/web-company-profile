<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\ContacController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\MasterHeadController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\PublicController;
use App\Models\MasterHead;
use Illuminate\Routing\RouteGroup;

Route::controller(PublicController::class)->group(function(){
   Route::get('/','index')->name('public');
   Route::get('data','getData')->name('public.data');
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
    Route::controller (MasterHeadController::class)->group (function(){
        Route::get('/master-head', 'index')->name('admin.master-head');
        Route::get('/master-head/data', 'getData')->name('admin.master-head.data');
        Route::post('/master-head/store', 'storeData')->name('admin.master-head.store'); 
        Route::get('/master-head/detail', 'detail')->name('admin.master-head.detail');
        Route::post('/master-head/update', 'updateData')->name('admin.master-head.update'); 
        Route::delete('/master-head/delete', 'deleteData')->name('admin.master-head.delete');
    });
    Route::controller (ContacController::class)->group (function(){
        Route::get('/contact', 'index')->name('admin.contact');
        Route::get('/contact/data', 'getData')->name('admin.contact.data');
        Route::delete('/contact/delete', 'deleteData')->name('admin.contact.delete');
    });
});
