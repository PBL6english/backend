<?php

use App\Http\Controllers\OnlineExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserExamEnrollController;
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
Route::get('/questiosns_by_exam/{id}',[QuestionController::class,'questions_by_exam']);
Route::post('/update_question/{id}',[QuestionController::class,'update']);
Route::delete('/delete_question/{id}',[QuestionController::class,'destroy']);
Route::delete('/delete_all_question_by_exam/{id}',[QuestionController::class,'destroy_all_in_exam']);

Route::get('/exams',[OnlineExamController::class,'index']);
Route::post('/addexam',[OnlineExamController::class,'create']);
Route::put('/update_exam/{id}',[OnlineExamController::class,'update']);
Route::delete('/delete_exam/{id}',[OnlineExamController::class,'destroy']);
Route::get('/show_exam/{id}',[OnlineExamController::class,'show']);
Route::get('/exams_by_user/{id}',[OnlineExamController::class,'ExamsByUser']);

Route::get('/Enroll_exam_list',[UserExamEnrollController::class,'index']);
Route::get('/Enroll_exam',[UserExamEnrollController::class,'create']);
Route::delete('/delete_enroll_exam',[UserExamEnrollController::class,'destroy']);