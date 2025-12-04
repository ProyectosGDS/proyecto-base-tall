<?php

use Illuminate\Support\Facades\Route;

Route::view('/login','auth.login')->name('login');

Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('home');

Route::view('/profile','profile')->middleware('auth')->name('profile');

