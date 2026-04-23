<!DOCTYPE html>
<html lang="<?= $language ?>">
<head><meta charset="UTF-8"><title>Contacts</title>
<style>body { background: <?= $bg_color ?>; color: <?= $text_color ?>; font-family: sans-serif; padding: 20px; }</style></head>
<body>
    <h1><?= ($language=='ru'?'Контактная информация':'Contact Information') ?></h1>
    <p><?= ($language=='ru'?'Адрес: ул. Кулинарная, 15':'Address: Culinary str, 15') ?></p>
    <p><?= ($language=='ru'?'Телефон: +7 (999) 123-45-67':'Phone: +7 (999) 123-45-67') ?></p>
    <a href="index.php" style="color: <?= $text_color ?>"><?= ($language=='ru'?'На главную':'Back Home') ?></a>
</body></html>
