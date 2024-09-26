<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/business/createsurvey', function () {
    return view('business.create');
});



Route::get('/user/dashboard', [SurveyController::class, 'dashboard'])->name('user.dashboard');

Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');
