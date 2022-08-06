<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CEOResources;
use App\Models\CEO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CEOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ceo = CEO::all();
        return response([
            'ceos' => CEOResources::collection($ceo),
            'message' => 'Retrived Successfully'
        ], status: 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required | max: 255',
            'company_name' => 'required | max: 255',
            'year' => 'required | max:255',
            'company_headquaters' => 'required|max:255',
            'what_company_does' => 'required',
        ]);

        if($validator->fails()){
            return response([
                'error' => $validator->errors(),
                'message' => 'Validation Fail'
            ],
            status: 400);
        }

        $ceo = CEO::create($data);
        return response(['ceo'=> new CEOResources($ceo), 'message' => 'created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CEO  $cEO
     * @return \Illuminate\Http\Response
     */
    public function show(CEO $cEO)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CEO  $cEO
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CEO $cEO)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CEO  $cEO
     * @return \Illuminate\Http\Response
     */
    public function destroy(CEO $cEO)
    {
        //
    }
}
