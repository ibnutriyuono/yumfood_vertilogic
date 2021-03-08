<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use App\Tag;
use App\Http\Requests\VendorRequest;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if (!$request['tags']) {
            return VendorResource::collection(Vendor::orderBy('id', 'asc')->paginate());
        } else {
            $tags = $request['tags'];
            return VendorResource::collection(Vendor::wherehas('tags', function ($q) use ($tags) {
                $q->whereIn('name', $tags);
            })->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        //
        $validated = $request->validated();
        $vendor = new Vendor;
        $vendor->name=$request['name'];
        $vendor->logo=$request['logo'];
        $sucessAddData = $vendor->save();
        if ($sucessAddData) {
            $tags = $request['tags'];
            if (!empty($tags)) {
                $tagList = explode(",", $tags);
                foreach ($tagList as $tags) {
                    $tag = Tag::firstOrCreate(['name' => $tags]);
                }
                $tags = Tag::whereIn('name', $tagList)->get()->pluck('id');
                $vendor->tags()->sync($tags);
            }
            return response()->json([
                "statusCode" => 200,
                "message" => "Success. $vendor[name] successfully added."
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
        try {
            return new VendorResource(Vendor::findOrFail($id)); 
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "message" => "Sorry. Data not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $vendor = Vendor::find($id);
        if ($vendor) {
            $vendor->name=$request['name'];
            $vendor->logo=$request['logo'];
            $successEditData = $vendor->save();
            if ($successEditData) {
                $tags = $request['tags'];
                if (!empty($tags)) {
                    $tagList = explode(",", $tags);
                    foreach ($tagList as $tags) {
                        $tag = Tag::firstOrCreate(['name' => $tags]);
                    }
                    $tags = Tag::whereIn('name', $tagList)->get()->pluck('id');
                    $vendor->tags()->sync($tags);
                }
                return response()->json([
                    "statusCode" => 200,
                    "message" => "Success. $vendor[name] successfully changed."
                ]);
            }
        } else {
            return response()->json([
                "statusCode" => 404,
                "message" => "Sorry. Data not found"
            ], 404);
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
        $vendor = Vendor::find($id);
        if ($vendor) {
            Vendor::destroy($id);
            return response()->json([
                "statusCode" => 200,
                "messsage" => "Success. $vendor[name] successfully deleted."
            ]);
        } else {
            return response()->json([
                "statusCode" => 404,
                "message" => "Sorry. Data not found"
            ], 404);
        }
    }
}
