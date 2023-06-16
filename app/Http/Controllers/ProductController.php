<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'code' => 200,
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'code' => 404,
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $data=Product::all();
        return $this->sendResponse($data,"Successfully");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $rule=[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
        ];
        
        $input=$request->only('name','description','price');
        $validator=Validator::make($input,$rule);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }
        $name=$request->name;
        $description=$request->description;
        $price=$request->price;
        $userid=$request->userid;
        $userid=Auth::id();
        $product=Product::create(['name'=>$name,'description'=>$description,'price'=>$price,'user_id'=>$userid]);
        if($product){
            return $this->sendResponse($product,"Create Successfully");
        }
        return $this->sendError("error","Create Fails");
        
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $userid=Auth::id();
        $data=User::find($userid)->products;
        return $this->sendResponse($data,"Successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
