<?php

use App\Http\Controllers\OnlineExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserExamEnrollController;
use App\Http\Controllers\UserExamQuestionAnswerController;
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


Route::controller(UserController::class)->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::put('/updateprofile/{id}', [UserController::class, 'update']);
    Route::post('/uploadavatar/{id}', [UserController::class, 'uploadAvatar']);
    Route::post('/deleteuser/{id}', [UserController::class, 'destroy']);
    Route::post('/changepassword', [UserController::class, 'change_password']);
    Route::get('/users', [UserController::class, 'index']);
});

Route::controller(QuestionController::class)->group(function () {
    Route::post('/addquestion',[QuestionController::class,'create']);
    Route::get('/questions',[QuestionController::class,'index']);
    Route::get('/questiosns_by_exam/{id}',[QuestionController::class,'questions_by_exam']);
    Route::post('/update_question/{id}',[QuestionController::class,'update']);
    Route::delete('/delete_question/{id}',[QuestionController::class,'destroy']);
    Route::delete('/delete_all_question_by_exam/{id}',[QuestionController::class,'destroy_all_in_exam']);
});

Route::controller(OnlineExamController::class)->group(function () {
    Route::get('/exams',[OnlineExamController::class,'index']);
    Route::post('/addexam',[OnlineExamController::class,'create']);
    Route::put('/update_exam/{id}',[OnlineExamController::class,'update']);
    Route::delete('/delete_exam/{id}',[OnlineExamController::class,'destroy']);
    Route::get('/show_exam/{id}',[OnlineExamController::class,'show']);
    Route::get('/exams_by_user/{id}',[OnlineExamController::class,'ExamsByUser']);
});

Route::controller(UserExamEnrollController::class)->group(function () {
    Route::get('/Enroll_exam_list',[UserExamEnrollController::class,'index']);
    Route::get('/Enroll_exam',[UserExamEnrollController::class,'create']);
    Route::get('/reset_enroll',[UserExamEnrollController::class,'reset_enroll']);
    Route::delete('/delete_enroll_exam',[UserExamEnrollController::class,'destroy']);
    Route::get('/view_exam_enroll_by_user',[UserExamEnrollController::class,'getbyuser']);
    Route::get('/view_all_exam_enroll_by_user/{id}',[UserExamEnrollController::class,'viewallbyuser']);
});

Route::controller(UserExamQuestionAnswerController::class)->group(function () {
    Route::get('/submit_exam',[UserExamQuestionAnswerController::class,'submit_exam']);
    Route::get('/getResultOfExamByUser',[UserExamQuestionAnswerController::class,'ViewResultOfExamByUser']);
});