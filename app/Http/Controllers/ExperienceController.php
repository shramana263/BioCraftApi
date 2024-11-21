<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Progress;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= new Experience();
        $data->starting_date= $request->starting_date;
        $data->ending_date= $request->ending_date;
        $data->role=$request->role;
        $data->organisation=$request->organisation;
        $data->description=$request->description;
        $data->user_id= auth()->id();
        $data->save();

        $progress= Progress::findOrFail(auth()->id());
        if($progress->step==3):
            $progress->step=4;
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
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        //
    }
}