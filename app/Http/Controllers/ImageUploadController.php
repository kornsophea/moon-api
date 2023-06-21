<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function index()
    {
        return view('imageUpload');
    }
      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
      
        $imageName = time().'.'.$request->image->extension();  
       
        $request->image->move(public_path('images'), $imageName);
        
        $image=Image::create(['image'=>$imageName]);
        return response(['image'=>$image]);
        // return back()
        //     ->with('success','You have successfully upload image.')
        //     ->with('image',$imageName); 
    }
    public function show(){
        $image=Image::all();
        return response([
            "image"=>$image
        ]);
    }
}
