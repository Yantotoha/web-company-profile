<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\ContacController;
use App\Http\Controllers\admin\ServicesController;
use App\Http\Controllers\admin\PortfolioController;
use App\Http\Controllers\admin\MasterHeadController;

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

    Route::controller (CategoryController::class)->group (function(){
        Route::get('/category', 'index')->name('admin.category');
        Route::get('/category/data', 'getData')->name('admin.category.data');
        Route::post('/category/store', 'storeData')->name('admin.category.store');
        Route::post('/category/update', 'updateData')->name('admin.category.update');
         Route::get('/category/detail', 'detail')->name('admin.category.detail');
    });

    Route::controller (ServicesController::class)->group (function(){
        Route::get('/service', 'index')->name('admin.service');
        Route::get('/service/data', 'getData')->name('admin.service.data');
        Route::post('/service/store', 'storeData')->name('admin.service.store'); 
        Route::get('/service/detail', 'detail')->name('admin.service.detail');
        Route::post('/service/update', 'updateData')->name('admin.service.update'); 
        Route::delete('/service/delete', 'deleteData')->name('admin.service.delete');
    });

    Route::controller (PortfolioController::class)->group (function(){
        Route::get('/portfolio', 'index')->name('admin.portfolio');
        Route::get('/portfolio/data', 'getData')->name('admin.portfolio.data');
        Route::post('/portfolio/store', 'storeData')->name('admin.portfolio.store'); 
        Route::get('/portfolio/detail', 'detail')->name('admin.portfolio.detail');
        Route::post('/portfolio/update', 'updateData')->name('admin.portfolio.update'); 
        Route::delete('/portfolio/delete', 'deleteData')->name('admin.portfolio.delete');
    });

    Route::controller (AboutController::class)->group (function(){
        Route::get('/about', 'index')->name('admin.about');
        Route::get('/about/data', 'getData')->name('admin.about.data');
        Route::post('/about/store', 'storeData')->name('admin.about.store'); 
        Route::get('/about/detail', 'detail')->name('admin.about.detail');
        Route::post('/about/update', 'updateData')->name('admin.about.update'); 
        Route::delete('/about/delete', 'deleteData')->name('admin.about.delete');
    });
    
    Route::controller (ContacController::class)->group (function(){
        Route::get('/contact', 'index')->name('admin.contact');
        Route::get('/contact/data', 'getData')->name('admin.contact.data');
        Route::delete('/contact/delete', 'deleteData')->name('admin.contact.delete');
    });
});
