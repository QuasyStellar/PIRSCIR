<?php
namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function index() {
        $dishes = Dish::with('category')->orderBy('id', 'desc')->get();
        $categories = Category::all();
        return view('admin', compact('dishes', 'categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        Dish::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);

        return redirect()->back()->with('success', session('language', 'ru') == 'ru' ? 'Блюдо успешно добавлено!' : 'Dish added successfully!');
    }

    public function runFixtures() {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'RestaurantSeeder']);
        return redirect('/')->with('success', session('language', 'ru') == 'ru' ? 'Данные успешно сгенерированы!' : 'Data generated successfully!');
    }
}
