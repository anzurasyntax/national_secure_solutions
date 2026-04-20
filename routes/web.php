<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});
Route::get('/services', function () {
    return view('services');
});
Route::get('/training', function () {
    return view('training');
});
Route::get('/contact-us', function () {
    return view('contact-us');
});
