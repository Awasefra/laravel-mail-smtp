<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('mails')->name('mails.')->controller(SendEmailController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/send', 'sendEmail')->name('send');
});
