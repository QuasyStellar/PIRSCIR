<?php
header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
$mysqli = new mysqli("db", "user", "password", "restaurant_db");
$mysqli->set_charset("utf8mb4");

if ($mysqli->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$entity = $_GET['entity'] ?? '';
$id = $_GET['id'] ?? null;

if ($entity === 'categories' || $entity === 'dishes') {
    if ($method === 'GET') {
        if ($id) {
            $res = $mysqli->query("SELECT * FROM $entity WHERE id=" . intval($id));
            if ($res && $res->num_rows > 0) echo json_encode($res->fetch_assoc());
            else echo json_encode(["error" => "Not found"]);
        } else {
            $res = $mysqli->query("SELECT * FROM $entity");
            $data = [];
            while ($row = $res->fetch_assoc()) $data[] = $row;
            echo json_encode($data);
        }
    } elseif ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        if ($entity === 'categories') {
            $name = $mysqli->real_escape_string($input['name']);
            $mysqli->query("INSERT INTO categories (name) VALUES ('$name')");
        } elseif ($entity === 'dishes') {
            $cat_id = intval($input['category_id']);
            $name = $mysqli->real_escape_string($input['name']);
            $price = floatval($input['price']);
            $mysqli->query("INSERT INTO dishes (category_id, name, price) VALUES ($cat_id, '$name', $price)");
        }
        echo json_encode(["status" => "created", "id" => $mysqli->insert_id]);
    } elseif ($method === 'PUT') {
        $input = json_decode(file_get_contents('php://input'), true);
        if ($id) {
            if ($entity === 'categories') {
                $name = $mysqli->real_escape_string($input['name']);
                $mysqli->query("UPDATE categories SET name='$name' WHERE id=" . intval($id));
            } elseif ($entity === 'dishes') {
                $cat_id = intval($input['category_id']);
                $name = $mysqli->real_escape_string($input['name']);
                $price = floatval($input['price']);
                $mysqli->query("UPDATE dishes SET category_id=$cat_id, name='$name', price=$price WHERE id=" . intval($id));
            }
            echo json_encode(["status" => "updated"]);
        }
    } elseif ($method === 'DELETE') {
        if ($id) {
            $mysqli->query("DELETE FROM $entity WHERE id=" . intval($id));
            echo json_encode(["status" => "deleted"]);
        }
    } else {
        echo json_encode(["error" => "Method not allowed"]);
    }
} else {
    echo json_encode(["error" => "Unknown entity. Use ?entity=categories or ?entity=dishes"]);
}
?>