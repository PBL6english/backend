<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = QuestionResource::collection(Question::all());
        return response()->json($question);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $question = new Question;
            $question->title = $request->title;
            $question->A = $request->A;
            $question->B = $request->B;
            $question->C = $request->C;
            $question->D = $request->D;
            $question->answer = $request->answer;
            $question->exam_id = $request->exam_id;
            if($request->hasFile('image'))
            {
                $destination_path ='images/questions';
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $first_question = Question::all()->first();
                $lastet = 1;
                if($first_question){
                    $lastet = Question::latest()->first()->id + 1;
                }
                $image_name = 'question_'.$lastet.".".$extension;
                $question->image = $request->file('image')->storeAs($destination_path, $image_name);
                $question->save();
                return new QuestionResource($question);
            }
            else
            {
                return response()->json(['message'=>'failed to create'], 404);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'failed to create'], 404);
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try {
            $question = Question::find($id);
            if(is_null($question)) {
                return response()->json(['message'=>'question not found'], 404);
            }
            $question->title = $request->title;
            $question->A = $request->A;
            $question->B = $request->B;
            $question->C = $request->C;
            $question->D = $request->D;
            $question->answer = $request->answer;
            if($request->hasFile('image'))
            {
                $destination_path ='images/questions';
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $first_question = Question::all()->first();
                $lastet = 1;
                if($first_question){
                    $lastet = $question->id;
                }
                $image_name = 'question_'.$lastet.".".$extension;
                $question->image = $request->file('image')->storeAs($destination_path, $image_name);
                $question->save();
                return new QuestionResource($question);
            }
            $question->save();
            return new QuestionResource($question);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'failed to update'], 404);
        }
    }

    public function questions_by_exam($id){
        try {
            //code...
            $questions = Question::where('exam_id',$id)->paginate(5);
            return response()->json($questions);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'questions not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        if(is_null($question)) {
            return response()->json(['message'=>'question not found'], 404);
        }
        $question->delete();
        $allquestion = question::all();
        return response()->json($allquestion);
    }

    public function destroy_all_in_exam($id)
    {
        $questions = Question::where('exam_id',$id);
        $questions->delete();
        $allquestion = question::all();
        return response()->json($allquestion);
    }
}
