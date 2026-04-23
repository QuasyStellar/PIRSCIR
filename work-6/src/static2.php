<?php require 'personalization.php'; ?>
<body style="background: <?= $bg_color ?>; color: <?= $text_color ?>; font-family: sans-serif; padding: 20px;">
    <h1><?= ($language=='ru'?'Контакты':'Contact Information') ?></h1>
    <p><?= ($language=='ru'?'Адрес: ул. Пушкина, д. Колотушкина':'Address: 123 Main St, City') ?></p>
    <a href="index.php" style="color: <?= $text_color ?>"><?= ($language=='ru'?'Назад':'Back') ?></a>
</body>
