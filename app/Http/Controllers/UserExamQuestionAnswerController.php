<?php

namespace App\Http\Controllers;

use App\Models\User_exam_question_answer;
use App\Http\Requests\StoreUser_exam_question_answerRequest;
use App\Http\Requests\UpdateUser_exam_question_answerRequest;
use App\Models\Question;
use App\Models\User_exam_enroll;
use Illuminate\Http\Request;

class UserExamQuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submit_exam(Request $request){
        $exam_enroll = User_exam_enroll::where(
            [
                ['quest_id','=',$request->user_id],
                ['exam_id','=',$request->exam_id],
            ]
        )->first();
        $exam_enroll->status = 1;
        $exam_enroll->save();

        $exam_enroll->User_exam_question_answer()->delete();
        $questions = Question::where('exam_id', $exam_enroll->exam_id)->get();
        foreach($questions as $question){
            $useranswer = new User_exam_question_answer;
            $useranswer->user_id = $exam_enroll->quest_id;
            $useranswer->exam_id = $exam_enroll->exam_id;
            $useranswer->enroll_id = $exam_enroll->id;
            $useranswer->question_id = $question->id;
            $useranswer->correct_answer = "A";
            if($question->B == $question->answer){
                $useranswer->correct_answer = "B";
            }
            else if($question->C == $question->answer){
                $useranswer->correct_answer = "C";
            }
            else if($question->D == $question->answer){
                $useranswer->correct_answer = "D";
            }
            $useranswer->save();
        }

        $exam_enroll->User_exam_question_answer()->get();
        $questions = Question::where('exam_id', $exam_enroll->exam_id)->get();
        $i = 0;
        $useranswers = User_exam_question_answer::where(
            [
                ['user_id','=',$exam_enroll->quest_id],
                ['exam_id','=',$exam_enroll->exam_id],
            ]
        )->get();
        foreach($useranswers as $useranswer){
            // $useranswer = new User_exam_question_answer;
            if(count($request['answer']) == $i){
                break;
            }
            else{
                $useranswer->user_answer = $request['answer'][$i];
                $useranswer->score_status = 0;
                // $useranswer->update(
                //     [
                //         ['user_answer' => $request['answer'][$i]],
                //         // ['score_status' => 0]
                //     ]
                // );
                if(strcmp($request['answer'][$i],$useranswer->correct_answer) === 0){
                    $useranswer->score_status = 1;
                }
                $i++;
                // $useranswer->correct_answer = $question->answer;
                $useranswer->save();
            }
        }
        $i = 0;
        $useranswers = User_exam_question_answer::where(
            [
                ['user_id','=',$exam_enroll->quest_id],
                ['exam_id','=',$exam_enroll->exam_id],
            ]
        )->get();
        $exam_enroll->save();
        return response()->json($useranswers);
    }

    public function ViewResultOfExamByUser(Request $request)
    {
        $useranswers = User_exam_question_answer::where(
            [
                ['user_id','=',$request->user_id],
                ['exam_id','=',$request->exam_id],
            ]
        )->get();
        return response()->json($useranswers);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUser_exam_question_answerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser_exam_question_answerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User_exam_question_answer  $user_exam_question_answer
     * @return \Illuminate\Http\Response
     */
    public function show(User_exam_question_answer $user_exam_question_answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User_exam_question_answer  $user_exam_question_answer
     * @return \Illuminate\Http\Response
     */
    public function edit(User_exam_question_answer $user_exam_question_answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUser_exam_question_answerRequest  $request
     * @param  \App\Models\User_exam_question_answer  $user_exam_question_answer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser_exam_question_answerRequest $request, User_exam_question_answer $user_exam_question_answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User_exam_question_answer  $user_exam_question_answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_exam_question_answer $user_exam_question_answer)
    {
        //
    }
}
