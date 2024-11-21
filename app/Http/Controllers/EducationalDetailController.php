<?php

namespace App\Http\Controllers;

use App\Models\EducationalDetail;
use App\Models\Progress;
use Illuminate\Http\Request;

class EducationalDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= EducationalDetail::where('user_id',auth()->id())->get();

        return response()->json([
            'data'=>$data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= new EducationalDetail();
        $data->degree = $request->degree;
        $data->school_university = $request->school_university;
        $data->year_of_passing = $request->year_of_passing;
        $data->percentage= $request->percentage;
        $data->gpa= $request->gpa;
        $data->user_id= auth()->id();

        $data->save();
        $progress= Progress::where('user_id',auth()->id())->first();
        if($progress->step==1):
            $progress->step=2;
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
    public function show(EducationalDetail $educationalDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationalDetail $educationalDetail,$id)
    {
        $data= EducationalDetail::findOrFail($id);

        if($data->user_id == auth()->id()):
            $data->degree = $request->degree;
            $data->school_university = $request->school_university;
            $data->year_of_passing = $request->year_of_passing;
            $data->percentage= $request->percentage;
            $data->gpa= $request->gpa;

            $data->save();

            return response()->json([
                'data'=>$data,
                'message'=>"Data updated successfully"
            ]);
        else:
            return response()->json([
                'message'=>"You are not authorized to edit this data"
            ],400);
        endif;
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationalDetail $educationalDetail)
    {
        //
    }
}
