<?php
namespace App\Models;

class Database {
    private static $instance = null;
    private $mysqli;

    private function __construct() {
        $this->mysqli = new \mysqli("db", "user", "password", "restaurant_db");
        $this->mysqli->set_charset("utf8mb4");
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->mysqli;
    }
}
