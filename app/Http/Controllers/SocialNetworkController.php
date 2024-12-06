<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= SocialNetwork::where('user_id', auth()->id())->get();
        if($data){

            return response()->json([
                'data'=>$data,
                'status'=>true
            ],200);
        }
        else{
            return response()->json([
                'message'=>'No data found',
                'status'=>false
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'nullable|max:255',
            'link'=>'nullable|max:255',
    
        ]);

        $data= new SocialNetwork();
        $data->name= $request->name;
        $data->link= $request->link;
        $data->user_id= auth()->id();

        $data->save();

        $progress= Progress::where('user_id',auth()->id())->first();
        if($progress->step==5):
            $progress->step=6;
            $progress->save();
        endif;

        return response()->json([
            'data'=>$data,
            'status'=>true,
            'message'=>'data uploaded successfully'
        ],201);


    }

    /**
     * Display the specified resource.
     */
    public function show(SocialNetwork $socialNetwork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialNetwork $socialNetwork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialNetwork $socialNetwork)
    {
        //
    }
}
