<?php
function require_auth() {
    require_once 'personalization.php'; // Чтобы получить $language
    $mysqli = new mysqli("db", "user", "password", "restaurant_db");
    $mysqli->set_charset("utf8mb4");
    
    $auth = false;
    
    if (isset($_SERVER['PHP_AUTH_USER'])) {
        $user = $_SERVER['PHP_AUTH_USER'];
        $pass = $_SERVER['PHP_AUTH_PW'];
    } elseif (isset($_SERVER['HTTP_AUTHORIZATION']) || isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
        $auth_header = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        if (strpos(strtolower($auth_header), 'basic') === 0) {
            $credentials = base64_decode(substr($auth_header, 6));
            if ($credentials !== false && strpos($credentials, ':') !== false) {
                list($user, $pass) = explode(':', $credentials, 2);
            }
        }
    }
    
    if (isset($user) && isset($pass)) {
        $user = $mysqli->real_escape_string($user);
        $pass = $mysqli->real_escape_string($pass);
        $res = $mysqli->query("SELECT * FROM users WHERE username='$user' AND password='$pass'");
        if ($res && $res->num_rows > 0) {
            $auth = true;
        }
    }
    
    if (!$auth) {
        header('WWW-Authenticate: Basic realm="Admin Area"');
        header('HTTP/1.0 401 Unauthorized');
        echo ($language == 'ru' ? 'Авторизация обязательна (Логин: admin, Пароль: admin)' : 'Authorization required (Login: admin, Password: admin)');
        exit;
    }
    
    return $mysqli;
}
?>