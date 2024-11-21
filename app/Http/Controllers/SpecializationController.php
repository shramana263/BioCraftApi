<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Specialization::where('user_id', auth()->id())->get();

        return response()->json([
            'data'=>$data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= new Specialization();
        $data->certificate= $request->certificate;
        $data->organisation= $request->organisation;
        $data->user_id= auth()->id();

        $data->save();
        $progress=Progress::where('user_id',auth()->id())->first();
        if($progress->step==2):
            $progress->step=3;
            $progress->save();
        endif;

        return response()->json([
            'data'=>$data,
            'progress'=>$progress->step
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialization $specialization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialization $specialization,$id)
    {
        $data = Specialization::findOrFail($id);
        if($data->user_id== auth()->id()):
            $data->certificate= $request->certificate;
            $data->organisation= $request->organisation;
            $data->save();
            return response()->json([
                'data'=>$data,
                'message'=>"Data updated successfully"
            ]);
        else:
            return response()->json([
                "message"=>'You are not authorized to edit this data'
            ],400);
        endif;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialization $specialization)
    {
        //
    }
}
