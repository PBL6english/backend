<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function register(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user);
    }

    public function login(Request $request){
        if(filter_var($request->email,FILTER_VALIDATE_EMAIL)){
            $user = User::where('email', $request->email)->first();
        }
        else{
            $user = User::where('name', $request->email)->first();
        }
        if($request->email == "" || $request->password == ""){
            return response()->json(["error"=>"Email or password is empty!"], 404);
        }
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(["error"=>"Email or password is not matched"], 404);
        }
        return response()->json($user);
    }

    public function change_password(Request $request){
        $input = array(
            'old_password' => $request->old_password,
            'new_password' => $request->new_password,
            'confirm_password' => $request->confirm_password,
        );
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            return response()->json(['message'=>$validator->errors()->first()], 404);
        } else {
            $user = User::findOrFail($request->user_id);
            if((Hash::check($request->old_password, $user->password)) == false){
                return response()->json(['message'=>"Check your old password"], 404);
            } else if ((Hash::check($request->new_password,$user->password)) == true){
                return response()->json(['message'=>"Please enter a new password that is not the same as the old password"], 404);
            } else {
                $user->update(['password' => Hash::make($request->new_password)]);
                return response()->json(new UserResource($user));
            }
            return response()->json(['message'=>"User not found"], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if(is_null($user)) {
            return response()->json(['message'=>'user not found'], 404);
        }
        $user->update($request->all());

        return new UserResource($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if(is_null($user)) {
            return response()->json(['message'=>'user not found'], 404);
        }
        $user->delete();
        $users = User::all();
        
        return response()->json($users);
    }

    public function uploadAvatar(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)) {
            return response()->json(['message'=>'user not found'], 404);
        }
        if($request->hasFile('avatar'))
        {
            $destination_path ='images/avatars';
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $avatar_name = 'user_avatar_'.$user->id.".".$extension;
            $user->avatar = $request->file('avatar')->storeAs($destination_path, $avatar_name);
            $user->save();
            return new UserResource($user);
        }
        else
        {
            return response()->json(['message'=>'file not found'], 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserResource::collection(User::all());
        return response()->json((($users)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
