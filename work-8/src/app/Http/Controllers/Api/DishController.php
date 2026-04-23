<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::with('category')->get();
        return response()->json($dishes, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dish = Dish::create($request->all());
        return response()->json([
            'status' => 'created',
            'dish' => $dish->load('category')
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dish = Dish::with('category')->find($id);

        if (!$dish) {
            return response()->json(['error' => 'Dish not found'], 404);
        }

        return response()->json($dish, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['error' => 'Dish not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:100',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dish->update($request->all());
        return response()->json([
            'status' => 'updated',
            'dish' => $dish->load('category')
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);

        if (!$dish) {
            return response()->json(['error' => 'Dish not found'], 404);
        }

        $dish->delete();
        return response()->json(['status' => 'deleted'], 200);
    }
}
