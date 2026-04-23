<?php
namespace App\Controllers;

use App\Models\Dish;
use App\Models\Database;

class AdminController {
    public function index() {
        require_once 'personalization.php';
        require_once 'auth.php';
        $mysqli = require_auth();
        
        $msg = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_dish'])) {
            $name = $_POST['name'];
            $price = floatval($_POST['price']);
            $cat_id = intval($_POST['category_id']);
            if (Dish::add($name, $price, $cat_id)) {
                $msg = ($language == 'ru' ? "<p style='color: green;'>Успешно!</p>" : "<p style='color: green;'>Success!</p>");
            }
        }

        $dishes = Dish::getAll();
        $db = Database::getInstance();
        $categories = $db->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);
        
        require_once 'views/admin.php';
    }
}
