<?php session_start(); require 'personalization.php'; ?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head><meta charset="UTF-8"><title>Work 5</title>
<style>body { background: <?= $bg_color ?>; color: <?= $text_color ?>; font-family: sans-serif; padding: 20px; }
.section { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
.btn { display: inline-block; padding: 10px 20px; border: 1px solid #ccc; text-decoration: none; color: inherit; border-radius: 4px; background: rgba(0,0,0,0.05); margin: 5px; }</style></head>
<body>
    <h1><?= ($language=='ru'?'Ресторан (Работа №5)':'Restaurant (Work 5)') ?></h1>
    <div class="section">
        <h3><?= ($language=='ru'?'Интерактивные разделы':'Interactive Sections') ?></h3>
        <a href="dynamic1.php" class="btn">→ <?= ($language=='ru'?'Просмотр меню':'View Menu') ?></a>
        <a href="dynamic2.php" class="btn">→ <?= ($language=='ru'?'Управление (Админка)':'Management (Admin)') ?></a>
        <a href="api.php?entity=dishes" class="btn" target="_blank">→ REST API</a>
    </div>
    <div class="section">
        <h3><?= ($language=='ru'?'Информационные страницы':'Information Pages') ?></h3>
        <a href="static1.php" class="btn">→ <?= ($language=='ru'?'О нашем ресторане':'About Us') ?></a>
        <a href="static2.php" class="btn">→ <?= ($language=='ru'?'Контактная информация':'Contacts') ?></a>
    </div>
    <div class="section">
        <h3><?= ($language=='ru'?'Дополнительно':'Extra') ?></h3>
        <a href="upload.php" class="btn"><?= ($language=='ru'?'Загрузка PDF':'Upload PDF') ?></a>
        <a href="personalization.php" class="btn"><?= ($language=='ru'?'Настройка темы':'Theme Settings') ?></a>
    </div>
</body></html>
