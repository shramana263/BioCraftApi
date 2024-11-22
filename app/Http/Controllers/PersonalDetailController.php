<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdRequest;
use App\Models\PersonalDetail;
use App\Models\Progress;
use App\Models\User;
use Illuminate\Http\Request;

class PersonalDetailController extends Controller
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
    public function store(PdRequest $request)
    {
        $data = [
            "fname" => $request->fname,
            "lname" => $request->lname,
            "gender" => $request->gender,
            "address" => $request->address,
            "contact_no" => $request->contact_no,
            "dob" => $request->dob,
            "user_id" => auth()->id()
        ];
        // $data=$request;

        $pd = new PersonalDetail();
        $pd->fname = $data['fname'];
        $pd->lname = $data['lname'];
        $pd->gender = $data['gender'];
        $pd->address = $data['address'];
        $pd->contact_no = $data['contact_no'];
        $pd->dob = $data['dob'];
        $pd->user_id = $data['user_id'];

        $pd->save();
        
        $progress= Progress::where('user_id', auth()->id())->first();
        if($progress->step==0):
            $progress->step=1;
            $progress->save();
        endif;

        // dd($request);
        // dd($data);

        return response()->json([
            'personal-details' => $pd,
            'step' => $progress->step
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $userId = auth()->id();
        $pd = PersonalDetail::where('user_id', $userId)->get();
        //dd($pd);

        return response()->json([
            'data' => $pd
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data= PersonalDetail::where('user_id',auth()->id())->first();
        $data->fname= $request->fname;
        $data->lname= $request->lname;
        $data->gender=$request->gender;
        $data->address=$request->address;
        $data->contact_no= $request->contact_no;
        $data->dob=$request->dob;

        $data->save();

        return response()->json([
            'data'=>$data,
            'message'=>"Data updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalDetail $personalDetail)
    {
        //
    }
}
