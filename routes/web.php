<?php

use Illuminate\Support\Facades\Route;

Route::impersonate();

Route::get('/', function () {
    if (env('APP_DEBUG') == 'true') {
        return view('welcome');
    } else {
        return redirect()->route('login');
    }
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dasbor::class)->name('admin-dashboard');
    Route::get('/saksi', \App\Livewire\SaksiReference::class)->name('saksi');
    Route::get('/saksi-admin', \App\Livewire\UserReference::class)->name('saksi-admin');
    Route::get('/saksi-koordinator', \App\Livewire\UserReference::class)->name('saksi-koordinator');
    Route::get('/paslon', \App\Livewire\PaslonReference::class)->name('paslon');
    Route::get('/formulir-c1', \App\Livewire\FormulirReference::class)->name('formulir-c1');
});
