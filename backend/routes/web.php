<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Visibilitycheck;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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


Route::middleware(['saml'])->group(function () {

    //Create a user session
    Route::get('/saml/login/user', [LoginController::class, 'loginWithSaml']);

    Route::middleware(['auth'])->group(function () {

        // Dashboard route
        Route::get('/', [HomeController::class, 'index'])
            ->name('home');

        //Visibilitycheck admin specific
        Route::resource('/questions', Visibilitycheck\QuestionController::class)
            ->except('show');

        Route::resource('/respondents', Visibilitycheck\RespondentController::class)
            ->only('index', 'show');

        Route::delete(
            '/respondets/purge',
            [Visibilitycheck\RespondentController::class, 'purge']
        )->name('respondents.purge');

        Route::resource('options', Visibilitycheck\QuestionOptionController::class)
            ->only('store', 'update', 'destroy');

        Route::resource('/pages', Visibilitycheck\PageController::class)
            ->only('index', 'edit', 'update');

        #Ordering of questions
        Route::get(
            'questions/order/{question}/{direction}',
            [Visibilitycheck\QuestionController::class, 'updateDisplayOrder']
        )->name('questions.order');

        Route::get(
            'options/order/{option}/{direction}',
            [Visibilitycheck\QuestionOptionController::class, 'updateDisplayOrder']
        )->name('options.order');

        Route::get('reports', [Visibilitycheck\ReportController::class, 'index'])->name('report.index');
        Route::get('reports/answers', [Visibilitycheck\ReportController::class, 'exportAnswers'])->name('report.answers');

    });

});

/**
+-----------+----------------------------------------+--------------------------------------------------------------------------------+
| Method    | URI                                    | Action                                                                         |
+-----------+----------------------------------------+--------------------------------------------------------------------------------+
| GET|HEAD  | /                                      | App\Http\Controllers\HomeController@index                                      |
| GET|HEAD  | api/questions                          | App\Http\Controllers\Visibilitycheck\Api\QuestionController@index              |
| GET|HEAD  | api/user                               | Closure                                                                        |
| POST      | options                                | App\Http\Controllers\Visibilitycheck\QuestionOptionController@store              |
| GET|HEAD  | options/order/{option}/{direction}     | App\Http\Controllers\Visibilitycheck\QuestionOptionController@updateDisplayOrder |
| PUT|PATCH | options/{option}                       | App\Http\Controllers\Visibilitycheck\QuestionOptionController@update             |
| DELETE    | options/{option}                       | App\Http\Controllers\Visibilitycheck\QuestionOptionController@destroy            |
| GET|HEAD  | pages                                  | App\Http\Controllers\Visibilitycheck\PageController@index                      |
| PUT|PATCH | pages/{page}                           | App\Http\Controllers\Visibilitycheck\PageController@update                     |
| GET|HEAD  | pages/{page}/edit                      | App\Http\Controllers\Visibilitycheck\PageController@edit                       |
| GET|HEAD  | questions                              | App\Http\Controllers\Visibilitycheck\QuestionController@index                  |
| POST      | questions                              | App\Http\Controllers\Visibilitycheck\QuestionController@store                  |
| GET|HEAD  | questions/create                       | App\Http\Controllers\Visibilitycheck\QuestionController@create                 |
| GET|HEAD  | questions/order/{question}/{direction} | App\Http\Controllers\Visibilitycheck\QuestionController@updateDisplayOrder     |
| PUT|PATCH | questions/{question}                   | App\Http\Controllers\Visibilitycheck\QuestionController@update                 |
| DELETE    | questions/{question}                   | App\Http\Controllers\Visibilitycheck\QuestionController@destroy                |
| GET|HEAD  | questions/{question}/edit              | App\Http\Controllers\Visibilitycheck\QuestionController@edit                   |
| GET|HEAD  | reports                                | App\Http\Controllers\Visibilitycheck\ReportController@index                    |
| GET|HEAD  | reports/answers                        | App\Http\Controllers\Visibilitycheck\ReportController@exportAnswers            |
| GET|HEAD  | respondents                            | App\Http\Controllers\Visibilitycheck\RespondentController@index                |
| GET|HEAD  | respondents/{respondent}               | App\Http\Controllers\Visibilitycheck\RespondentController@show                 |
| DELETE    | respondets/purge                       | App\Http\Controllers\Visibilitycheck\RespondentController@purge                |
| GET|HEAD  | saml/login                             | SimplerSaml\Http\Controllers\SamlController@login                              |
| GET|HEAD  | saml/login/user                        | App\Http\Controllers\LoginController@loginWithSaml                             |
| GET|HEAD  | saml/logout                            | SimplerSaml\Http\Controllers\SamlController@logout                             |
+-----------+----------------------------------------+--------------------------------------------------------------------------------+
 **/




