<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;
use App\Dish;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return OrderResource::collection(Order::orderBy('id', 'asc')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        //
        try {
            $price = Dish::findOrFail($request['dish_id'])['price'];
            $amount = $price * $request['quantity'];
            $validated = $request->validated();
            $order = new Order;
            $order->vendor_id = $request['vendor_id'];
            $order->dish_id = $request['dish_id'];
            $order->user_id = $request['user_id'];
            $order->quantity = $request['quantity'];
            $order->amount = $price * $request['quantity'];
            $sucessAddData = $order->save();
            if ($sucessAddData) {
                return response()->json([
                    "statusCode" => 200,
                    "message" => "Success. Order number $order[id] successfully added."
                ]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "message" => "Sorry. Data not found"
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            return new OrderResource(Order::findOrFail($id)); 
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        //
        try {
            $price = Dish::findOrFail($request['dish_id'])['price'];
            $amount = $price * $request['quantity'];
            $validated = $request->validated();
            $order = Order::find($id);
            $order->vendor_id = $request['vendor_id'];
            $order->dish_id = $request['dish_id'];
            $order->user_id = $request['user_id'];
            $order->quantity = $request['quantity'];
            $order->amount = $price * $request['quantity'];
            $successEditData = $order->save();
            if ($successEditData) {
                return response()->json([
                    "statusCode" => 200,
                    "message" => "Success. Order number $order[id] successfully changed."
                ]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "message" => "Sorry. Data not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $vendor = Order::find($id);
        if ($vendor) {
            Order::destroy($id);
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
