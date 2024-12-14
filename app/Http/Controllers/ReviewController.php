<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Review::where('parent_id',0)->get();
        if($data){
            return response()->json([
                'data'=>$data,
                'message'=>'data fetched succssfully',
                'status'=>true
            ]);
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
        $data= new Review();      
        if($request->name==null){
            $data->name='anonymous';
        }
        else{
            $data->name= $request->name;
        }
        $data->review= $request->review;
        $data->user_id= auth()->id();
        $data->is_reply= $request->is_reply??0;
        $data->parent_id= $request->parent_id?? 0;

        $data->save();

        return response()->json([
            'message'=>'Review Posted Successfully',
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review, $id)
    {
        $data = Review::findOrFail($id);
        if($data->user_id == auth()->id())
        {
            $data->destroy();
            return response()->json([
                'message'=>'Review Deleted Successfully'
            ]);
        }
        else{
            return response()->json([
                'message'=>'You are not authorized to delete this review'
            ]);
        }
    }
}
