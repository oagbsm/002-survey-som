<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/business/createsurvey', function () {
    return view('business.create');
});

Route::post('/survey/{id}/submit', [SurveyController::class, 'submitAnswers'])->name('survey.submit');


Route::get('/user/dashboard', [SurveyController::class, 'dashboard'])->name('user.dashboard');

Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');


// Route for the dashboard to display all surveys
Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');

// Route for displaying a specific survey's details
Route::get('/survey/{id}', [SurveyController::class, 'show'])->name('survey.show');

// Route for submitting the survey responses
Route::post('/survey/{id}/submit', [SurveyController::class, 'submitAnswers'])->name('survey.submit');