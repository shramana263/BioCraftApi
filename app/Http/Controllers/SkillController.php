<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Skill::where('user_id',auth()->id())->get();

        return response()->json([
            'data'=>$data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= new Skill();
        $data->skill= $request->skill;
        $data->user_id=auth()->id();
        $data->save();

        $progress= Progress::where('user_id',auth()->id())->first();
        if($progress->step==4):
            $progress->step=5;
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
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill, $id)
    {
        $data = Skill::findOrFail($id);

        if($data->user_id==auth()->id()):
            $data->skill= $request->skill;
            $data->save();

            return response()->json([
                'data'=>$data,
                'message'=>"Data updated successfully"
            ]);
        else:
            return response()->json([
                "message"=>"You are not authorized to edit this data"
            ],400);
        endif;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
