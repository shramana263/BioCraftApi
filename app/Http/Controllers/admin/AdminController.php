<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->role !== 'admin'){
            return response()->json([
                'message'=>'Unauthorized',
                'status'=>false
            ],401);
        }
        $users= User::all();
        if(!$users){
            return response()->json([
                'message'=>'No data found',
                'status'=>false
            ]);
        }
        return response()->json([
            'data'=>$users,
            'status'=>true
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(auth()->user()->role !== 'admin'){
            return response()->json([
                'message'=>'Unauthorized',
                'status'=>false
            ],401);
        }
        $user= User::findOrFail($id);
        return response()->json([
            'data'=>$user,
            'status'=>true
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
