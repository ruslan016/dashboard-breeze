<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'iso'=>'required|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()->toArray(),
            ]);
        }else{
            $counry = new Country();
            $counry->name = $request->input('name');
            $counry->iso = $request->input('iso');
            $counry->user_id = auth()->id();
            $counry->save();

            return response()->json([
                'status'=>200,
                'message'=>'Country Added Successfully',
            ]);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $countries = Country::all();

        return response()->json([
            'countries' => $countries,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);

        if(isset($country) && !empty($country)){
            return response()->json([
                'status' => 200,
                'country' => $country,
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' =>'Country Not Found',
            ]);
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:191',
            'iso'=>'required|max:191',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()->toArray(),
            ]);
        }else{
            $country = Country::find($id);

            if(isset($country) && !empty($country)){
                $country->name = $request->input('name');
                $country->iso = $request->input('iso');
                $country->user_id = auth()->id();
                $country->update();

            return response()->json([
                'status'=>200,
                'message'=>'Country Updated Successfully',
            ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' =>'Country Not Found',
                ]);
            }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
