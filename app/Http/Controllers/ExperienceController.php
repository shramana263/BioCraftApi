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
        $data = Experience::where('user_id',auth()->id())->get();

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
        $data= new Experience();
        $data->starting_date= $request->starting_date;
        $data->ending_date= $request->ending_date;
        $data->role=$request->role;
        $data->organisation=$request->organisation;
        $data->description=$request->description;
        $data->user_id= auth()->id();
        $data->save();

        $progress= Progress::where('user_id',auth()->id())->first();
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
    public function show(Experience $experience, $id)
    {
        $data = Experience::findOrFail($id);
        if($data){
            return response()->json([
                'data'=>$data,
                'message'=>'data fetched successfully'
            ]);
        }
        else{
            return response()->json([
                "message"=>'Error in data fetching'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience, $id)
    {
        $data = Experience::findOrFail($id);
        if($data->user_id == auth()->id()):
            $data->starting_date= $request->starting_date;
            $data->ending_date= $request->ending_date;
            $data->role=$request->role;
            $data->organisation=$request->organisation;
            $data->description=$request->description;
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
    public function destroy(Experience $experience, $id)
    {
        $data = Experience::findOrFail($id);

        if($data){
            $data->delete();
            return response()->json([
                'message'=>'Data deleted successfully'
            ]);
        }
        else{
            return response()->json([
                'message'=>'Error in deleting the data'
            ]);
        }
    }
}
