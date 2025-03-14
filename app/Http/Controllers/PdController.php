<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdRequest;
use App\Models\tbl_pd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdController extends Controller
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

        // $pd= new tbl_pd();
        // $pd->fname= $data['fname'];
        // dd("personal"+$pd);
        

        // dd($request);
        dd($data);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
