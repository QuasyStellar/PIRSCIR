<?php
$cookie_expire = time() + (30 * 24 * 60 * 60);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['set_pref'])) {
    setcookie('user_login', $_POST['login'], $cookie_expire, '/');
    setcookie('theme', $_POST['theme'], $cookie_expire, '/');
    setcookie('language', $_POST['lang'], $cookie_expire, '/');
    header("Location: index.php");
    exit;
}
$user_login = $_COOKIE['user_login'] ?? 'Guest';
$theme = $_COOKIE['theme'] ?? 'light';
$language = $_COOKIE['language'] ?? 'ru';
$bg_color = ($theme === 'dark') ? '#333' : '#fff';
$text_color = ($theme === 'dark') ? '#fff' : '#000';

$labels = [
    'ru' => [
        'title' => 'Настройки',
        'login' => 'Логин',
        'theme' => 'Тема',
        'theme_light' => 'Светлая',
        'theme_dark' => 'Темная',
        'lang' => 'Язык',
        'save' => 'Сохранить',
        'cancel' => 'Отмена'
    ],
    'en' => [
        'title' => 'Settings',
        'login' => 'Login',
        'theme' => 'Theme',
        'theme_light' => 'Light',
        'theme_dark' => 'Dark',
        'lang' => 'Language',
        'save' => 'Save',
        'cancel' => 'Cancel'
    ]
];

$l = $labels[$language] ?? $labels['en'];

if (basename($_SERVER['PHP_SELF']) == 'personalization.php'): ?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head><meta charset="UTF-8"><title><?= $l['title'] ?></title></head>
<body style="background: <?= $bg_color ?>; color: <?= $text_color ?>; font-family: sans-serif; padding: 20px;">
    <h1><?= $l['title'] ?></h1>
    <form method="POST">
        <?= $l['login'] ?>: <input type="text" name="login" value="<?= htmlspecialchars($user_login) ?>"><br><br>
        <?= $l['theme'] ?>: <select name="theme">
            <option value="light" <?= $theme=='light'?'selected':'' ?>><?= $l['theme_light'] ?></option>
            <option value="dark" <?= $theme=='dark'?'selected':'' ?>><?= $l['theme_dark'] ?></option>
        </select><br><br>
        <?= $l['lang'] ?>: <select name="lang">
            <option value="ru" <?= $language=='ru'?'selected':'' ?>>RU</option>
            <option value="en" <?= $language=='en'?'selected':'' ?>>EN</option>
        </select><br><br>
        <button type="submit" name="set_pref"><?= $l['save'] ?></button>
    </form>
    <br><a href="index.php" style="color: <?= $text_color ?>"><?= $l['cancel'] ?></a>
</body></html>
<?php endif; ?>
