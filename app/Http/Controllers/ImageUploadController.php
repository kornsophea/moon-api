<?php

namespace App\Http\Controllers;

use App\Http\Requests\DigitalOceanStoreRequest as RequestsDigitalOceanStoreRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'code' => 200,
            'success' => true,
            'message' => $message,
            'data'    => $result,

        ];
        return response()->json($response, 200);
    }
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'code' => 404,
            'success' => false,
            'message' => $error,
            'data' => null,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
    public function index()
    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'stringBase64' => 'required',
    //         'extansion'=>'required'
    //     ]);


    //     $base64_image = "data:image/jpeg;base64, blahblahablah";

    //     if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
    //         Storage::disk('do')->put(Str::random(10).".png", $base64_image);
    //         dd("stored");
    //     }



    //     $file=base64_decode($request['stringBase64']);

    //     $extansion=$request['extansion'];

    //     $imageName=Str::random(10).'.'.$extansion;

    //     $url = Storage::disk('do')->put(
    //         "moonli/".$imageName,
    //         $file,'public'
    //     );

    //     $image = Image::create(['image' => $url]);
    //     return $this->sendResponse($image, "Upload Successfully");
    // }
    public function store(RequestsDigitalOceanStoreRequest $request)
    {
        $file = $request->doctorProfileImageFile;

        $url = Storage::disk('do')->putFile(
            "moonli",
            $file,
            'public'
        );

        $image = Image::create(['image' => $url]);
        return $this->sendResponse($image, "Upload Successfully");
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $imageName = time().'.'.$request->image->extension();  

    //     $request->image->move(public_path('images'), $imageName);

    //     $image=Image::create(['image'=>$imageName]);
    //     return response(['image'=>$image]);
    //     // return back()
    //     //     ->with('success','You have successfully upload image.')
    //     //     ->with('image',$imageName); 
    // }
    public function show()
    {
        $image = Image::all();
        return response([
            "image" => $image
        ]);
    }
}
