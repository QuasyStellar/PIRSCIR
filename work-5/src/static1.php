<?php require 'personalization.php'; ?>
<body style="background: <?= $bg_color ?>; color: <?= $text_color ?>; font-family: sans-serif; padding: 20px;">
    <h1><?= ($language=='ru'?'О нашем ресторане':'About Our Restaurant') ?></h1>
    <p><?= ($language=='ru'?'Мы готовим с любовью с 1998 года.':'Cooking with love since 1998.') ?></p>
    <a href="index.php" style="color: <?= $text_color ?>"><?= ($language=='ru'?'Назад':'Back') ?></a>
</body>
