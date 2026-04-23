<?php
namespace App\Core;

use App\Models\Database;

class Auth {
    public static function requireAuth() {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            self::sendAuthHeaders();
        } else {
            $user = $_SERVER['PHP_AUTH_USER'];
            $pass = $_SERVER['PHP_AUTH_PW'];
            
            $db = Database::getInstance();
            $user = $db->real_escape_string($user);
            $pass = $db->real_escape_string($pass);
            
            $res = $db->query("SELECT * FROM users WHERE username='$user' AND password='$pass'");
            
            if ($res->num_rows === 0) {
                self::sendAuthHeaders();
            }
            
            return $db;
        }
    }

    private static function sendAuthHeaders() {
        header('WWW-Authenticate: Basic realm="Admin Area"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Authentication required';
        exit;
    }
}
