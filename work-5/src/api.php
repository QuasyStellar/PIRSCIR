<?php
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
        if ($id) {
            $stmt = $mysqli->prepare("SELECT * FROM $entity WHERE id = ?");
            $id_int = intval($id);
            $stmt->bind_param("i", $id_int);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $res->num_rows > 0) echo json_encode($res->fetch_assoc(), JSON_UNESCAPED_UNICODE);
            else echo json_encode(["error" => "Not found"]);
        } else {
            $res = $mysqli->query("SELECT * FROM $entity");
            $data = [];
            while ($row = $res->fetch_assoc()) $data[] = $row;
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }

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

    } elseif ($method === 'PUT') {
        $input = json_decode(file_get_contents('php://input'), true);
        $id_int = intval($id);
        $name = $input['name'] ?? '';

        if (!$id) {
            echo json_encode(["error" => "ID required for PUT"]);
            exit;
        }

        if ($entity === 'categories') {
            $stmt = $mysqli->prepare("UPDATE categories SET name = ? WHERE id = ?");
            $stmt->bind_param("si", $name, $id_int);
        } else {
            $cat_id = intval($input['category_id'] ?? 0);
            $price = floatval($input['price'] ?? 0);
            $stmt = $mysqli->prepare("UPDATE dishes SET category_id = ?, name = ?, price = ? WHERE id = ?");
            $stmt->bind_param("isdi", $cat_id, $name, $price, $id_int);
        }

        if ($stmt->execute()) {
            echo json_encode(["status" => "updated"], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["error" => $stmt->error]);
        }

    } elseif ($method === 'DELETE') {
        if (!$id) {
            echo json_encode(["error" => "ID required for DELETE"]);
            exit;
        }
        $stmt = $mysqli->prepare("DELETE FROM $entity WHERE id = ?");
        $id_int = intval($id);
        $stmt->bind_param("i", $id_int);
        if ($stmt->execute()) {
            echo json_encode(["status" => "deleted"]);
        } else {
            echo json_encode(["error" => $stmt->error]);
        }
    }
} else {
    echo json_encode(["error" => "Unknown entity"]);
}
?>
