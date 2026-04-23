<?php
namespace App\Controllers;

use App\Models\Dish;
use App\Models\Database;
use App\Core\Auth;

class AdminController extends BaseController {
    public function index() {
        Auth::requireAuth();
        
        $msg = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_dish'])) {
            $name = $_POST['name'];
            $price = floatval($_POST['price']);
            $cat_id = intval($_POST['category_id']);
            if (Dish::add($name, $price, $cat_id)) {
                $msg = ($this->language == 'ru' ? "<p style='color: green;'>Успешно!</p>" : "<p style='color: green;'>Success!</p>");
            }
        }

        $dishes = Dish::getAll();
        $db = Database::getInstance();
        $categories = $db->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);
        
        $this->render('admin', [
            'msg' => $msg,
            'dishes' => $dishes,
            'categories' => $categories
        ]);
    }
}
