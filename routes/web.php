<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/todoapp', function () {
    return view('todoapp');
})->name('todoapp');

Route::get('/user', function () {
    return view('user');
})->name('user');
