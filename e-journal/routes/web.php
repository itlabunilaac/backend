<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/demo');
});

Route::get('/demo', function () {
    return response()->file(public_path('demo.html'));
});

Route::get('/api-demo', function () {
    return response()->file(public_path('demo.html'));
});
