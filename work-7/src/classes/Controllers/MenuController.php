<?php
namespace App\Controllers;

use App\Models\Dish;

class MenuController {
    public function index() {
        require_once 'personalization.php'; // Получаем настройки темы и языка
        $dishes = Dish::getAll();
        require_once 'views/menu.php';
    }
}
