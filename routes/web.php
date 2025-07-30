<?php

use Illuminate\Support\Facades\Route;

Route::impersonate();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dasbor::class)->name('admin-dashboard');
    Route::get('/saksi',\App\Livewire\SaksiReference::class)->name('saksi');

});
