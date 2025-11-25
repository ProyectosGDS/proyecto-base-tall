<?php

use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('user',[UserController::class,'index'])->name('user.index');
Route::get('user/{id}',[UserController::class,'show'])->name('user.show');

Route::get('permission',[PermissionsController::class,'index'])->name('permissions');
Route::get('area',[PermissionsController::class,'index'])->name('areas');
Route::get('page',[PagesController::class,'index'])->name('pages');
Route::get('profile',[ProfileController::class,'index'])->name('profiles');
Route::get('menu',[MenusController::class,'index'])->name('menus');
Route::get('role',[RolesController::class,'index'])->name('roles');