<?php
namespace App\Controllers;

use App\Models\Dish;
use App\Models\Database;

class ApiController extends BaseController {
    public function handle() {
        header("Content-Type: application/json; charset=UTF-8");
        $method = $_SERVER['REQUEST_METHOD'];
        $entity = $_GET['entity'] ?? '';
        $id = $_GET['id'] ?? null;

        if ($entity === 'categories' || $entity === 'dishes') {
            if ($method === 'GET') {
                $db = Database::getInstance();
                if ($id) {
                    $res = $db->query("SELECT * FROM $entity WHERE id = " . intval($id));
                    $data = $res->fetch_assoc();
                    echo json_encode($data ?: ["error" => "Not found"], JSON_UNESCAPED_UNICODE);
                } else {
                    $res = $db->query("SELECT * FROM $entity");
                    echo json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE);
                }
            } elseif ($method === 'POST') {
                $input = json_decode(file_get_contents('php://input'), true);
                if ($entity === 'categories') {
                    // Logic for categories
                } else {
                    $name = $input['name'] ?? '';
                    $cat_id = intval($input['category_id'] ?? 0);
                    $price = floatval($input['price'] ?? 0);
                    if (Dish::add($name, $price, $cat_id)) {
                        echo json_encode(["status" => "created", "name" => $name], JSON_UNESCAPED_UNICODE);
                    }
                }
            }
        }
    }
}
