<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('user',[UserController::class,'index'])->name('user.index');
Route::get('user/{id}',[UserController::class,'show'])->name('user.show');

Route::get('permission',[PermissionsController::class,'index'])->name('permissions');
Route::get('area',[AreaController::class,'index'])->name('areas');
Route::get('page',[PagesController::class,'index'])->name('pages');
Route::get('role',[RolesController::class,'index'])->name('roles');