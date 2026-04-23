<?php
namespace App\Controllers;

class SettingsController extends BaseController {
    public function index() {
        $this->render('personalization');
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['set_pref'])) {
            $cookie_expire = time() + (30 * 24 * 60 * 60);
            setcookie('user_login', $_POST['login'], $cookie_expire, '/');
            setcookie('theme', $_POST['theme'], $cookie_expire, '/');
            setcookie('language', $_POST['lang'], $cookie_expire, '/');
        }
        header("Location: index.php?action=settings");
    }
}
