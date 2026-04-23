<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Dish;

Route::get('/dishes', function (Request $request) {
    return response()->json(Dish::with('category')->get(), 200, ['Content-Type' => 'application/json;charset=UTF-8'], JSON_UNESCAPED_UNICODE);
});
