<?php

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserRolePermission\RolePermissionController;
use App\Http\Controllers\Admin\UserRolePermission\PermissionController;
use App\Http\Controllers\Admin\UserRolePermission\RoleController;
use App\Http\Controllers\Admin\UserRolePermission\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;



use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('front_home');
Route::get('/article/{slug}', [FrontendController::class, 'showArticle'])->name('article.show');
Route::get('/category/{slug}', [FrontendController::class, 'showCategory'])->name('category.show');
Route::get('/tag/{slug}', [FrontendController::class, 'showTag'])->name('tag.show');
Route::get('/articles_all', [FrontendController::class, 'allArticles'])->name('articles_all');
Route::get('/search', [FrontendController::class, 'search'])->name('search');


// Comment routes
Route::post('/article/{article}/comment', [CommentController::class, 'store'])->name('comments.store');
Route::post('/comment/{comment}/like', [CommentController::class, 'like'])->name('comments.like');

// Route

Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('login',[AuthController::class,'loginStore'])->name('login.store');
Route::get('register',[AuthController::class,'register'])->name('register');
Route::post('register',[AuthController::class,'registerStore'])->name('register.store');

Route::group(['middleware'=>'auth'],function(){
    Route::post('logout',[AuthController::class,'logout'])->name('logout');
    Route::get('home',[DashboardController::class,'index'])->name('home');
    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);
    Route::get('roletopermission',[RolePermissionController::class,'roletopermission'])->name('roletopermission');
    Route::put('updateroletopermission/{id}',[RolePermissionController::class,'updateroletopermission'])->name('updateroletopermission');

    Route::resource('categories',CategoryController::class);
    Route::resource('articles',ArticleController::class);
    Route::resource('tags',TagController::class);
});

//test
Route::get('/apidata',[FrontendController::class,'getDataByApi'])->name('apidata');
