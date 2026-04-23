<?php
namespace App\Models;

class Category {
    public static function getAll() {
        $db = Database::getInstance();
        $res = $db->query("SELECT * FROM categories");
        return $res->fetch_all(MYSQLI_ASSOC);
    }
}
