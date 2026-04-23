<?php
namespace App\Models;

class Statistic {
    public static function getRatingDistribution() {
        $db = Database::getInstance();
        return $db->query("SELECT rating, COUNT(*) as count FROM statistics GROUP BY rating")->fetch_all(MYSQLI_NUM);
    }

    public static function getPriceDynamics($limit = 20) {
        $db = Database::getInstance();
        return $db->query("SELECT price FROM statistics LIMIT " . intval($limit))->fetch_all(MYSQLI_NUM);
    }

    public static function getDishesByCategory() {
        $db = Database::getInstance();
        return $db->query("SELECT category_id, COUNT(*) as count FROM statistics GROUP BY category_id")->fetch_all(MYSQLI_NUM);
    }

    public static function count() {
        $db = Database::getInstance();
        $row = $db->query("SELECT COUNT(*) as count FROM statistics")->fetch_assoc();
        return $row['count'] ?? 0;
    }

    public static function clear() {
        $db = Database::getInstance();
        return $db->query("DELETE FROM statistics");
    }

    public static function add($name, $cat_id, $price, $rating, $date) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO statistics (name, category_id, price, rating, created_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sidss", $name, $cat_id, $price, $rating, $date);
        return $stmt->execute();
    }
}
