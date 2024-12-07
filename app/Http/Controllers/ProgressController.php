<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progress= Progress::where('user_id', auth()->id())->first();
    
        return response()->json(
             $progress,
        );
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
    public function show(Progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Progress $progress)
    {
        $data= Progress::where('user_id',auth()->id())->first();
        $data->step=$request->step;
        $data->save();

        return response()->json([
            'data'=>$data,
            'message'=>'Progress Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        //
    }
}
