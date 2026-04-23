<?php
namespace App\Controllers;

use App\Models\Dish;

class MenuController extends BaseController {
    public function index() {
        $dishes = Dish::getAll();
        $this->render('menu', ['dishes' => $dishes]);
    }
}
