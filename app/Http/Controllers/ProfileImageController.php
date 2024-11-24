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
            'image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);

       if($request->has('image')){
        $file= $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $fileName= time().'.'.$extension;

        $path='uploads/profile-images/';
        $file->move($path,$fileName);

        // ProfileImage::create([
        //     'filename'=>$filename,
        //     'user_id'=>auth()->id()
        // ]);
        $data= new ProfileImage();
        $data->filename= $path.$fileName;
        $data->user_id= auth()->id();

        $data->save();

        return response()->json([
            'data'=>$data,
            'status'=>true
        ]);
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileImage $profileImage)
    {
        $data= ProfileImage::where('user_id',auth()->id())->first();
        if($data){

            $imageUrl= 'http://biodatamakerapi.local/'.$data->filename;
            return response()->json([
                'url'=>$imageUrl,
                'status'=>true
            ],200);
        }
        else{
                return response()->json([
                    'url'=>'http://biodatamakerapi.local/assets/dummy-profile-img.jpg',
                    'status'=>false
                ],204);
        }

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
