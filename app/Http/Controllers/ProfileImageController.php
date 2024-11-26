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
        $images = ProfileImage::where('user_id', auth()->id())->get();
        if ($images == null) {
            return response()->json([
                'url' => 'http://biodatamakerapi.local/assets/dummy-profile-img.jpg',
                'status' => false
            ], 200);
        } else {

            // foreach( $images as $image){
            //     $imageUrl= 'http://biodatamakerapi.local/'.$image->filename;
            // }
            $imageUrls = $images->map(function ($image) {
                return 'http://biodatamakerapi.local/' . $image->filename;
            })->toArray();

            return response()->json([
                'url' => $imageUrls,
                'status' => true
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;

            $path = 'uploads/profile-images/';
            $file->move($path, $fileName);

            // ProfileImage::create([
            //     'filename'=>$filename,
            //     'user_id'=>auth()->id()
            // ]);
            $data = new ProfileImage();
            $data->filename = $path . $fileName;
            $data->active_status = 1;
            $data->user_id = auth()->id();

            $data->save();

            return response()->json([
                'data' => $data,
                'status' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileImage $profileImage)
    {
        $data = ProfileImage::where('user_id', auth()->id())->where('active_status', 1)->first();
        if ($data == null) {
            return response()->json([
                'url' => 'http://biodatamakerapi.local/assets/dummy-profile-img.jpg',
                'status' => false
            ], 200);
        } else {

            $imageUrl = 'http://biodatamakerapi.local/' . $data->filename;
            return response()->json([
                'id' => $data->id,
                'url' => $imageUrl,
                'status' => true
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfileImage $profileImage, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // 'filename' => 'required',
            'active_status' => 'required',
            // Add more validation rules as needed
        ]);

        // Find the model instance to update
        // $model = ProfileImage::find($id);
        ProfileImage::where('id', $id)->update($request->all());
        // Update the model instance
        // $model->update($validatedData);
        // $model->save();

        // Return a success response
        return response()->json(['message' => 'Data updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileImage $profileImage)
    {
        //
    }
}
