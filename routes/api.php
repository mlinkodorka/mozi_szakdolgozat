<?php

use App\Http\Controllers\NyelvController;
use App\Models\Nyelv;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;


Route::get('/nyelvek', function () {
    return Nyelv::all();
});
