<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('mails')->name('mails.')->controller(SendEmailController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/send', 'sendEmail')->name('send');
    Route::prefix('attachs')->name('attachs.')->group(function () {
        Route::get('/', 'indexWithAttach');
        Route::post('/send', 'sendEmailWithAttachment')->name('send');
    });
});
