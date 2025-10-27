<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Visibilitycheck;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Visibilitycheck admin specific
Route::resource('/questions', Visibilitycheck\Api\QuestionController::class)
    ->only('index');

Route::get(
    '/user', [Visibilitycheck\Api\RespondentController::class, 'fetch']);

Route::post(
    '/user/answer', [Visibilitycheck\Api\RespondentController::class, 'saveAnswer']);

Route::get(
    '/user/score', [Visibilitycheck\Api\RespondentController::class, 'getUserScore']);

