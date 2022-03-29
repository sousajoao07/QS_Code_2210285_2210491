<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index(Request $request){
        if($request->has('page')){
            return UserResource::collection(User::paginate(5));
        }else{
            //return Resource::collection(User::all());
            return UserResource::collection(User::paginate(5));
        }
    }

    public function test(){
        
        return response()->json(['msg' => 'test with success'], 200);

    }

    public function delete($id){
        $user= User::findOrFail($id);
        $user->delete();
        return response()->json(null,204);
    }

    public function getUserById($id){
        return new UserResource(User::find($id));
    }

    public function update(Request $request, $id){
        
        $request->validate([
            'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'email' => 'required|string|email', 
            'password' => 'required|string|confirmed'
        ]);
        $user= User::findOrFail($id);
        $data = $request->all();
        if(Hash::check($data['old_password'], $user->password)){
            $request->merge(['password' => Hash::make($request->get('password'))]);
            $user->fill($request->all());
            
        }else{
            return response()->json(['error' => 'Password Confirmation Wrong.'], 401);
        }
 
        $user->save();
        return (new UserResource($user))->response()->setStatusCode(200);
    }

   

    public function updateWithoutPass(Request $request, $id){
        
        $request->validate([
            'name' => 'required|string|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'email' => 'required|string|email',
        ]);
        $user= User::findOrFail($id);
        $user->fill($request->all());
        $user->save();
        return (new UserResource($user))->response()->setStatusCode(200);
    }



}
