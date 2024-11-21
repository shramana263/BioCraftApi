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
        //
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
        $progress=Progress::findOrFail(auth()->id());
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
    public function update(Request $request, Specialization $specialization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialization $specialization)
    {
        //
    }
}
