<?php

namespace App\Http\Controllers;

use App\Models\User_exam_enroll;
use App\Http\Requests\StoreUser_exam_enrollRequest;
use App\Http\Requests\UpdateUser_exam_enrollRequest;
use App\Models\Online_exam;
use App\Models\Question;
use App\Models\User_exam_question_answer;
use Illuminate\Http\Request;

class UserExamEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User_exam_enroll::all(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // try {
            //code...
            $exam_enroll_exist = User_exam_enroll::where([
                ['quest_id','=',$request->user_id],
                ['exam_id','=',$request->exam_id],
            ])->get();
            if(!$exam_enroll_exist->isEmpty()){
                return response()->json(['message'=>'you allready enrolled this exam'], 200);
            }
            $exam_enroll = new User_exam_enroll();
            $exam_enroll->quest_id = $request->user_id;
            $exam_enroll->exam_id = $request->exam_id;
            $exam_enroll->save();
            $questions = Question::where('exam_id', $request->exam_id)->get();
            foreach($questions as $question){
                $useranswer = new User_exam_question_answer;
                $useranswer->user_id = $request->user_id;
                $useranswer->exam_id = $request->exam_id;
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
            $useranswers = User_exam_question_answer::where(
                [
                    ['user_id','=',$request->user_id],
                    ['exam_id','=',$request->exam_id],
                ]
            )->get();
            return response()->json($useranswers);
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return response()->json(['message'=>'exam not found'], 404);
        // }
    }

    public function reset_enroll(Request $request){
        $exam_enroll = User_exam_enroll::where(
            [
                ['quest_id','=',$request->user_id],
                ['exam_id','=',$request->exam_id],
            ]
        )->first();
        $exam_enroll->status = 0;
        $exam_enroll->save();
        $exam_enroll->User_exam_question_answer()->delete();
        $questions = Question::where('exam_id', $exam_enroll->exam_id)->get();
        foreach($questions as $question){
            $useranswer = new User_exam_question_answer;
            $useranswer->user_id = $exam_enroll->user_id;
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
        $useranswers = User_exam_question_answer::where(
            [
                ['user_id','=',$exam_enroll->user_id],
                ['exam_id','=',$exam_enroll->exam_id],
            ]
        )->get();
        $exam_enroll->save();
        return response()->json($useranswers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUser_exam_enrollRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser_exam_enrollRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User_exam_enroll  $user_exam_enroll
     * @return \Illuminate\Http\Response
     */
    public function getbyuser(Request $request)
    {
        $exam_enroll = User_exam_enroll::where(
            [
                ['quest_id',$request->user_id],
                ['exam_id',$request->exam_id],
            ]
        )->first();
        return response()->json($exam_enroll);
    }

    public function viewallbyuser($id)
    {
        $exam_enroll = User_exam_enroll::where('quest_id',$id)->first();
        return response()->json($exam_enroll);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User_exam_enroll  $user_exam_enroll
     * @return \Illuminate\Http\Response
     */
    public function edit(User_exam_enroll $user_exam_enroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUser_exam_enrollRequest  $request
     * @param  \App\Models\User_exam_enroll  $user_exam_enroll
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser_exam_enrollRequest $request, User_exam_enroll $user_exam_enroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User_exam_enroll  $user_exam_enroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $exam_enroll = User_exam_enroll::where([
            ['quest_id','=',$request->user_id],
            ['exam_id','=',$request->exam_id],
        ]);
        $exam_enroll->delete();
        $all = User_exam_enroll::all();
        return response()->json($all);
    }
}
