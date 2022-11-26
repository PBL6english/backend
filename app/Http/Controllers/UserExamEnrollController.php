<?php

namespace App\Http\Controllers;

use App\Models\User_exam_enroll;
use App\Http\Requests\StoreUser_exam_enrollRequest;
use App\Http\Requests\UpdateUser_exam_enrollRequest;
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
        try {
            //code...
            $exam_enroll_exist = User_exam_enroll::where([
                ['user_id','=',$request->user_id],
                ['exam_id','=',$request->exam_id],
            ])->get();
            if(!$exam_enroll_exist->isEmpty()){
                return response()->json(['message'=>'you allready enrolled this exam'], 200);
            }
            $exam_enroll = new User_exam_enroll();
            $exam_enroll->user_id = $request->user_id;
            $exam_enroll->exam_id = $request->exam_id;
            $exam_enroll->status = $request->status;
            $exam_enroll->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message'=>'exam not found'], 404);
        }
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
    public function show(User_exam_enroll $user_exam_enroll)
    {
        //
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
            ['user_id','=',$request->user_id],
            ['exam_id','=',$request->exam_id],
        ]);
        $exam_enroll->delete();
        $all = User_exam_enroll::all();
        return response()->json($all);
    }
}
