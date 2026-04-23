<?php
namespace App\Http\Controllers;

use App\Models\Dish;

class MenuController extends Controller {
    public function index() {
        $dishes = Dish::with('category')->get();
        return view('menu', compact('dishes'));
    }
}
