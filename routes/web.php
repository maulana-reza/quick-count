<?php

use Illuminate\Support\Facades\Route;

Route::impersonate();

Route::get('/', function () {
//    if (env('APP_DEBUG') == 'true') {
//        return view('welcome');
//    } else {
        if (auth()->check()) {
            if (auth()->user()->hasRole(\App\Models\User::ADMIN)) {
                return redirect()->route('admin-dashboard');
            } elseif (auth()->user()->hasRole(\App\Models\User::ADMIN_SAKSI)) {
                return redirect()->route('saksi-admin-dashboard');
            } elseif (auth()->user()->hasRole(\App\Models\User::KOORDINATOR_SAKSI)) {
                return redirect()->route('saksi-koordinator-dashboard');
            } else if (auth()->user()->hasRole(\App\Models\User::SAKSI)) {
                return redirect()->route('saksi-dashboard');
            }
        }
        return redirect()->route('login');
//    }
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dasbor::class)
        ->can('admin-dashboard')
        ->name('admin-dashboard');
    Route::get('/saksi', \App\Livewire\SaksiReference::class)
        ->can('saksi')
        ->name('saksi');
    Route::get('/saksi-admin', \App\Livewire\UserReference::class)
        ->can('saksi-admin')
        ->name('saksi-admin');
    Route::get('/saksi-koordinator', \App\Livewire\UserReference::class)
        ->can('saksi-koordinator')
        ->name('saksi-koordinator');
    Route::get('/paslon', \App\Livewire\PaslonReference::class)
        ->can('paslon')
        ->name('paslon');
    Route::get('/formulir-c1', \App\Livewire\FormulirReference::class)
        ->can('formulir-c1')
        ->name('formulir-c1');
    Route::get('/formulir-c1-validasi', \App\Livewire\FormulirReference::class)
        ->can('formulir-c1-validasi')
        ->name('formulir-c1-validasi');
    Route::get('/statistik', \App\Livewire\Admin\Chart::class)
        ->can('statistik')
        ->name('statistik');
    Route::get('/call-center', \App\Livewire\CallCenterReference::class)
        ->can('call-center')
        ->name('call-center');
    Route::get('tps',\App\Livewire\TpsReference::class)
        ->can('tps')
        ->name('tps');
    Route::get('/saksi-dashboard', \App\Livewire\Saksi\Dasbor::class)
        ->can('saksi-dashboard')
        ->name('saksi-dashboard');
    Route::get('/koordinator-saksi-dashboard', \App\Livewire\KoordinatorSaksi\Dasbor::class)
        ->can('saksi-koordinator-dashboard')
        ->name('saksi-koordinator-dashboard');
    Route::get('/input-formulir', \App\Livewire\Saksi\Input::class)
        ->can('formulir-input')
        ->name('formulir-input');
});

Route::prefix('saksi-admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'last_user_activity',
    'role:' . \App\Models\User::ADMIN_SAKSI,
])->group(function () {
    Route::get('/dasbor', \App\Livewire\AdminSaksi\Dasbor::class)
        ->can('saksi-admin-dashboard')
        ->name('saksi-admin-dashboard');
});
