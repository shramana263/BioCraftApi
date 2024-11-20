<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdRequest;
use App\Models\PersonalDetail;
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
        $data=[
            "fname"=>$request->fname,
            "lname"=>$request->lname,
            "gender"=>$request->gender,
            "address"=>$request->address,
            "contact_no"=>$request->contact_no,
            "dob"=>$request->dob,
            "user_id"=>auth()->id()
        ];
        // $data=$request;

        $pd= new PersonalDetail();
        $pd->fname= $data['fname'];
        $pd->lname= $data['lname'];
        $pd->gender= $data['gender'];
        $pd->address= $data['address'];
        $pd->contact_no= $data['contact_no'];
        $pd->dob= $data['dob'];
        $pd->user_id= $data['user_id'];

        $pd->save();
        
        // dd($request);
        // dd($data);

        return response()->json([
            $pd
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonalDetail $personalDetail)
    {
        //

        if (true):
            dd();
        endif;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PersonalDetail $personalDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalDetail $personalDetail)
    {
        //
    }
}
