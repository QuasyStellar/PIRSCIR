<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($language == 'ru' ? 'Меню ресторана (MVC)' : 'Restaurant Menu (MVC)'); ?></title>
    <style>
        body { background: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>; font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; color: <?php echo $text_color; ?>; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        a { color: <?php echo ($theme === 'dark') ? '#4dbaff' : '#007bff'; ?>; }
    </style>
</head>
<body>
    <h1><?php echo ($language == 'ru' ? 'Меню нашего ресторана' : 'Our Restaurant Menu'); ?></h1>
    <table>
        <tr>
            <th><?php echo ($language == 'ru' ? 'Категория' : 'Category'); ?></th>
            <th><?php echo ($language == 'ru' ? 'Название' : 'Name'); ?></th>
            <th><?php echo ($language == 'ru' ? 'Цена' : 'Price'); ?></th>
        </tr>
        <?php foreach ($dishes as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['cat_name']); ?></td>
                <td><?php echo htmlspecialchars($row['dish_name']); ?></td>
                <td><?php echo $row['price']; ?>$</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br><a href="index.php"><?php echo ($language == 'ru' ? 'На главную' : 'Back Home'); ?></a>
</body>
</html>
