<?php

use App\Http\Controllers\OnlineExamController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/addquestion',[QuestionController::class,'create']);
Route::get('/questions',[QuestionController::class,'index']);
Route::get('/exams',[OnlineExamController::class,'index']);
Route::get('/addexam',[OnlineExamController::class,'create']);
Route::get('/questiosns_by_exam/{id}',[QuestionController::class,'questionByExam']);
Route::post('/update_question/{id}',[QuestionController::class,'update']);
Route::put('/update_exam/{id}',[OnlineExamController::class,'update']);
Route::delete('/delete_question/{id}',[QuestionController::class,'destroy']);
Route::delete('/delete_all_question_by_exam/{id}',[QuestionController::class,'destroy_all_in_exam']);
Route::delete('/delete_exam/{id}',[OnlineExamController::class,'destroy']);