<?php
namespace App\Models;

class Dish {
    public static function getAll() {
        $db = Database::getInstance();
        $res = $db->query("SELECT dishes.name as dish_name, dishes.price, categories.name as cat_name FROM dishes 
                           JOIN categories ON dishes.category_id = categories.id");
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public static function add($name, $price, $cat_id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO dishes (category_id, name, price) VALUES (?, ?, ?)");
        $stmt->bind_param("isd", $cat_id, $name, $price);
        return $stmt->execute();
    }
}
