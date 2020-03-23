<?php

namespace App\Http\Controllers;

use App\HandledRequests;
use App\Http\Resources\HandledRequestResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HandledRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HandledRequestResource::collection(HandledRequests::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
        $handledRequest = HandledRequests::create($request->all());
        return new HandledRequestResource($handledRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HandledRequests  $handledRequest
     * @return \Illuminate\Http\Response
     */
    public function show(HandledRequests $handledRequest)
    {
        return new HandledRequestResource($handledRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HandledRequests  $handledRequests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HandledRequests $handledRequests)
    {
        $validator=$this->validator($request->all());
        if($validator->fails())
            return response()->json(['errors'=>$validator->errors()->all()],401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HandledRequests  $handledRequests
     * @return \Illuminate\Http\Response
     */
    public function destroy(HandledRequests $handledRequests)
    {
        //
    }

    public function validator($data)
    {
        $rules=[
            'request_id' => 'required|numeric',
            'blood_product_id' => 'required|numeric',
            'handled_by' => 'required|numeric',

        ];
        return Validator::make($data,$rules);
    }
}
