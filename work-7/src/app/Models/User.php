<?php
namespace App\Models;

class User {
    public static function authenticate($username, $password) {
        $db = Database::getInstance();
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);
        $res = $db->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
        return $res->fetch_assoc();
    }
}
