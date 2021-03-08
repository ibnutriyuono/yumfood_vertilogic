<?php

namespace App\Http\Controllers;

use App\Http\Resources\DishResource;
use App\Dish;   
use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Requests\DishRequest;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return DishResource::collection(Dish::orderBy('id', 'asc')->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(VendorRequest $request)
    {
        //
        $validated = $request->validated();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishRequest $request)
    {
        //
        $validated = $request->validated();
        $dish = new Dish;
        $dish->name=$request['name'];
        $dish->vendor_id=$request['vendor_id'];
        $sucessAddData = $dish->save();
        if ($sucessAddData) {
            return response()->json([
                "statusCode" => 200,
                "message" => "Success. $dish[name] successfully added."
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            return new DishResource(Dish::findOrFail($id)); 
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "message" => "Sorry. Data not found"
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
