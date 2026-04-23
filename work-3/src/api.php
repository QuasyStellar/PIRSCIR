<?php
error_reporting(0);
ini_set('display_errors', 0);
header("Content-Type: application/json; charset=UTF-8");
mb_internal_encoding("UTF-8");

$method = $_SERVER['REQUEST_METHOD'];
$mysqli = new mysqli("db", "user", "password", "restaurant_db");

if ($mysqli->connect_error) {
    die(json_encode(["error" => "DB Connection failed"]));
}

$mysqli->query("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
$mysqli->set_charset("utf8mb4");

$entity = $_GET['entity'] ?? '';
$id = $_GET['id'] ?? null;

if ($entity === 'categories' || $entity === 'dishes') {
    if ($method === 'GET') {
        $res = $id 
            ? $mysqli->query("SELECT * FROM $entity WHERE id = " . intval($id))
            : $mysqli->query("SELECT * FROM $entity");
        
        $data = [];
        while ($row = $res->fetch_assoc()) $data[] = $row;
        echo json_encode($id ? ($data[0] ?? ["error" => "Not found"]) : $data, JSON_UNESCAPED_UNICODE);

    } elseif ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $name = $input['name'] ?? '';

        if ($entity === 'categories') {
            $stmt = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");
            $stmt->bind_param("s", $name);
        } else {
            $cat_id = intval($input['category_id'] ?? 0);
            $price = floatval($input['price'] ?? 0);
            $stmt = $mysqli->prepare("INSERT INTO dishes (category_id, name, price) VALUES (?, ?, ?)");
            $stmt->bind_param("isd", $cat_id, $name, $price);
        }

        if ($stmt && $stmt->execute()) {
            echo json_encode(["status" => "created", "id" => $mysqli->insert_id, "name" => $name], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => $mysqli->error]);
        }
    } elseif ($method === 'PUT' && $id) {
        $input = json_decode(file_get_contents('php://input'), true);
        if ($entity === 'categories') {
            $name = $input['name'] ?? '';
            $stmt = $mysqli->prepare("UPDATE categories SET name = ? WHERE id = ?");
            $stmt->bind_param("si", $name, $id);
        } else {
            $name = $input['name'] ?? '';
            $cat_id = intval($input['category_id'] ?? 0);
            $price = floatval($input['price'] ?? 0);
            $stmt = $mysqli->prepare("UPDATE dishes SET category_id = ?, name = ?, price = ? WHERE id = ?");
            $stmt->bind_param("isdi", $cat_id, $name, $price, $id);
        }

        if ($stmt && $stmt->execute()) {
            echo json_encode(["status" => "updated", "id" => $id], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => $mysqli->error]);
        }
    } elseif ($method === 'DELETE' && $id) {
        $stmt = $mysqli->prepare("DELETE FROM $entity WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt && $stmt->execute()) {
            echo json_encode(["status" => "deleted", "id" => $id], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => $mysqli->error]);
        }
    }
} else {
    // Самодокументируемое API (Документация при пустом запросе)
    echo json_encode([
        "api_name" => "Restaurant REST API",
        "version" => "1.0",
        "description" => "Данный API позволяет управлять меню ресторана (категориями и блюдами).",
        "authentication" => "Basic Auth (используйте логин/пароль из ПР №3)",
        "endpoints" => [
            "categories" => [
                "url" => "?entity=categories",
                "methods" => [
                    "GET" => "Получение списка всех категорий или конкретной через &id=X",
                    "POST" => "Создание категории. Body: { \"name\": \"Название\" }",
                    "PUT" => "Обновление категории (&id=X). Body: { \"name\": \"Новое название\" }",
                    "DELETE" => "Удаление категории (&id=X)"
                ]
            ],
            "dishes" => [
                "url" => "?entity=dishes",
                "methods" => [
                    "GET" => "Получение списка всех блюд или конкретной через &id=X",
                    "POST" => "Создание блюда. Body: { \"category_id\": 1, \"name\": \"Название\", \"price\": 100 }",
                    "PUT" => "Обновление блюда (&id=X). Body: { \"category_id\": 1, \"name\": \"Название\", \"price\": 120 }",
                    "DELETE" => "Удаление блюда (&id=X)"
                ]
            ]
        ]
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>
