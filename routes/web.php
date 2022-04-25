<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homepage');
});

Route::get('candidates', [CandidateController::class, 'index']);
Route::get('candidates-list', [CandidateController::class, 'list']);
Route::post('candidates-contact', [CandidateController::class, 'contact']);
Route::post('candidates-hire', [CandidateController::class, 'hire']);

Route::get('/contact-mailable', function () {
    return new App\Mail\ContactCandidate;
});
Route::get('/hire-mailable', function () {
    return new App\Mail\HireCandidate;
});
