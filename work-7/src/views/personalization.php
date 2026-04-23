<!DOCTYPE html>
<html lang="<?= $language ?>">
<head><meta charset="UTF-8"><title><?= $l['title'] ?></title>
<style>body { background: <?= $bg_color ?>; color: <?= $text_color ?>; font-family: sans-serif; padding: 20px; }</style></head>
<body>
    <h1><?= $l['title'] ?></h1>
    <form action="index.php?action=update_settings" method="POST">
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
