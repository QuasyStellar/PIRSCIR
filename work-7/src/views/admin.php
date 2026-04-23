<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($language == 'ru' ? 'Управление (MVC)' : 'Management (MVC)'); ?></title>
    <style>
        body { background: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>; font-family: sans-serif; padding: 20px; }
        .form-section { border: 1px solid #888; padding: 15px; margin-bottom: 30px; border-radius: 5px; max-width: 400px; }
        table { border-collapse: collapse; width: 100%; color: <?php echo $text_color; ?>; }
        th, td { border: 1px solid #888; padding: 10px; }
    </style>
</head>
<body>
    <h1><?php echo ($language == 'ru' ? 'Управление меню (MVC)' : 'Menu Management (MVC)'); ?></h1>
    <div class="form-section">
        <?php echo $msg; ?>
        <form action="index.php?action=admin" method="POST">
            <input type="text" name="name" placeholder="Name" required><br><br>
            <input type="number" step="0.01" name="price" placeholder="Price" required><br><br>
            <select name="category_id">
                <?php foreach($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <button type="submit" name="add_dish">Add</button>
        </form>
    </div>

    <h3><?php echo ($language == 'ru' ? 'Текущее меню' : 'Current Menu'); ?></h3>
    <table>
        <tr>
            <th>ID</th>
            <th><?php echo ($language == 'ru' ? 'Название' : 'Name'); ?></th>
            <th><?php echo ($language == 'ru' ? 'Цена' : 'Price'); ?></th>
            <th><?php echo ($language == 'ru' ? 'Категория' : 'Category'); ?></th>
        </tr>
        <?php foreach ($dishes as $dish): ?>
            <tr>
                <td><?php echo $dish['id'] ?? '-'; ?></td>
                <td><?php echo htmlspecialchars($dish['dish_name']); ?></td>
                <td><?php echo $dish['price']; ?>$</td>
                <td><?php echo htmlspecialchars($dish['cat_name']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br><a href="index.php" style="color: <?php echo $text_color; ?>"><?php echo ($language == 'ru' ? 'На главную' : 'Back Home'); ?></a>
</body>
</html>
