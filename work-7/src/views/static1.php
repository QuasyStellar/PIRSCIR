<!DOCTYPE html>
<html lang="<?= $language ?>">
<head><meta charset="UTF-8"><title>About Us</title>
<style>body { background: <?= $bg_color ?>; color: <?= $text_color ?>; font-family: sans-serif; padding: 20px; }</style></head>
<body>
    <h1><?= ($language=='ru'?'О нашем ресторане':'About Our Restaurant') ?></h1>
    <p><?= ($language=='ru'?'Мы открылись в 2024 году и готовим лучшую еду в городе.':'We opened in 2024 and cook the best food in town.') ?></p>
    <a href="index.php" style="color: <?= $text_color ?>"><?= ($language=='ru'?'На главную':'Back Home') ?></a>
</body></html>
