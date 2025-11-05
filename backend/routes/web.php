<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Visibilitycheck;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('dashboard');
//});

Route::redirect('/', '/admin')->name('root');

Route::middleware('auth')->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');


        //Visibilitycheck admin specific
        Route::resource(
            '/questions',
            Visibilitycheck\QuestionController::class
        )->except('show');

        // Topics management (no delete; disable/enable only)
        Route::resource(
            '/topics',
            Visibilitycheck\TopicController::class
        )->except(['show', 'destroy']);
        Route::patch(
            '/topics/{topic}/toggle',
            [Visibilitycheck\TopicController::class, 'toggle']
        )->name('topics.toggle');

        Route::resource(
            '/respondents',
            Visibilitycheck\RespondentController::class
        )->only('index', 'show');

        Route::delete(
            '/respondets/purge',
            [Visibilitycheck\RespondentController::class, 'purge']
        )->name('respondents.purge');

        Route::resource('options', Visibilitycheck\QuestionOptionController::class)
            ->only('store', 'update', 'destroy');

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

        /*
         * End of visibility check routes
         */

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
