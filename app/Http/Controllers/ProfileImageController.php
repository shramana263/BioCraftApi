<?php

namespace App\Http\Controllers;

use App\Models\ProfileImage;
use Illuminate\Http\Request;

class ProfileImageController extends Controller
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
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $filename);

        $imageModel = ProfileImage::create(['filename' => $filename,'user_id'=>auth()->id()]);

        return response()->json([
            'success' => true,
            'data' => $imageModel,
            'message' => 'Image uploaded successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileImage $profileImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfileImage $profileImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileImage $profileImage)
    {
        //
    }
}
