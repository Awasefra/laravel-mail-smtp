<?php

use App\Http\Controllers\PayRollController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('mails')->name('mails.')->group(function () {
    Route::controller(SendEmailController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/send', 'sendEmail')->name('send');
        Route::prefix('attachs')->name('attachs.')->group(function () {
            Route::get('/', 'indexWithAttach');
            Route::post('/send', 'sendEmailWithAttachment')->name('send');
        });
    });

    Route::prefix('payrolls')->name('payrolls.')->controller(PayRollController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/send', 'send')->name('send');
        Route::prefix('batch')->name('batch.')->group(function () {
            Route::get('/', 'indexBatch');
            Route::post('/send', 'sendBatch')->name('send');
        });
    });
});
