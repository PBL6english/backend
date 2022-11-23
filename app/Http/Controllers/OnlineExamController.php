<?php

namespace App\Http\Controllers;

use App\Models\Online_exam;
use App\Http\Requests\StoreOnline_examRequest;
use App\Http\Requests\UpdateOnline_examRequest;
use App\Http\Resources\OnlineExamResource;
use Illuminate\Http\Request;

class OnlineExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OnlineExamResource::collection(Online_exam::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $exam = new Online_exam();
            $exam->title = $request->title;
            $exam->total_question = $request->total_question;
            $exam->duration = $request->duration;
            $exam->user_id = $request->user_id;
            $exam->save();
            return new OnlineExamResource($exam);
        } catch (\Throwable $th) {
            return response()->json(['message'=>'failed to create'], 404);
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOnline_examRequest  $request
     * @param  \App\Models\Online_exam  $online_exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $exam = Online_exam::find($id);
            if(is_null($exam)) {
                return response()->json(['message'=>'question not found'], 404);
            }
            $exam->title = $request->title;
            $exam->total_question = $request->total_question;
            $exam->duration = $request->duration;
            $exam->save();
            return new OnlineExamResource($exam);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'failed to update'], 404); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Online_exam  $online_exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Online_exam::find($id);
        if(is_null($exam)) {
            return response()->json(['message'=>'question not found'], 404);
        }
        $exam->delete();
        $allexam = Online_exam::all();
        
        return response()->json($allexam);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOnline_examRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOnline_examRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Online_exam  $online_exam
     * @return \Illuminate\Http\Response
     */
    public function show(Online_exam $online_exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Online_exam  $online_exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Online_exam $online_exam)
    {
        //
    }
}
