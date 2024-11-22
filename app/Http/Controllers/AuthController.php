<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {

        $data = [
            "email" => $request->email,
            "password" => $request->password,
        ];

        if (!Auth::attempt($data)) {
            return response()->json([
                "status" => false,
                "message" => "Wrong credentials"
            ], 400);
        }

        $token = Auth::user()->createToken("MyToken")->plainTextToken;
        return response()->json([
            "status" => true,
            "token" => $token,
            "data" => Auth::user(),
            "message" => "Successful login"
        ], 201);
    }
    
    
    public function registration(RegistrationRequest $request)
    {

        // dd($request->all());
        $data = $request->validated();
        // $data->name="Samir";
        // $data->email="Samir";
        // $data->password="Samir";
        // dd($data['name']);
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        // $user=User::create(['name' => $name, 'email' => $email, 'password' =>$password]);
        $user->save();

        $token = $user->createToken("MyToken")->plainTextToken;
            $progress = new Progress();
            $progress->step=0;
            $progress->user_id= $user->id;
            $progress->save();
        

        return response()->json([
            "status" => true,
            "token" => $token,
            "message" => "Successful login"
        ], 201);
    }

    public function user(Request $request){
        return $request->user();
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        // $loginToken =User::find(Auth::user()->id)->token()->revoke();

        return response(['message' => 'Successfully logged out'],201);
    }

}
