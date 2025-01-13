<?php

use App\Http\Controllers\NyelvController;
use App\Models\Nyelv;
use Illuminate\Support\Facades\Route;

Route::get('/a', function () {
    return view('welcome');
});

Route::get('/nyelvek', function () {
    return Nyelv::all();
});
