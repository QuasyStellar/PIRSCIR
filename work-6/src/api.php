<?php
header("Content-Type: application/json; charset=UTF-8");
mb_internal_encoding("UTF-8"); // Установка внутренней кодировки PHP

$method = $_SERVER['REQUEST_METHOD'];
$mysqli = new mysqli("db", "user", "password", "restaurant_db");

if ($mysqli->connect_error) {
    die(json_encode(["error" => "DB Connection failed"]));
}

// ПРИНУДИТЕЛЬНАЯ НАСТРОЙКА ОКРУЖЕНИЯ
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

        if ($stmt->execute()) {
            echo json_encode(["status" => "created", "id" => $mysqli->insert_id, "name" => $name], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => $stmt->error]);
        }
    }
}
?>
