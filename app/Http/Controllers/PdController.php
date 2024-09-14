<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdRequest;
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
            "country"=>$request->country,
            "user_id"=>auth()->id()
        ];

        dd($request);
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
