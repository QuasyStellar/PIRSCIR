<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'personalization.php';
require_once 'auth.php';
$mysqli = require_auth(); // Базовая авторизация

// 1. Обработка добавления нового блюда
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_dish'])) {
    $name = $mysqli->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    $cat_id = intval($_POST['category_id']);
    
    if ($name && $price > 0 && $cat_id > 0) {
        $stmt = $mysqli->prepare("INSERT INTO dishes (category_id, name, price) VALUES (?, ?, ?)");
        $stmt->bind_param("isd", $cat_id, $name, $price);
        if ($stmt->execute()) {
            $msg = ($language == 'ru' ? "<p style='color: green;'>Блюдо успешно добавлено!</p>" : "<p style='color: green;'>Dish added successfully!</p>");
        } else {
            $msg = ($language == 'ru' ? "<p style='color: red;'>Ошибка БД: " . $stmt->error . "</p>" : "<p style='color: red;'>DB Error: " . $stmt->error . "</p>");
        }
    }
}

// 2. Получение данных для таблицы
$res = $mysqli->query("SELECT dishes.id, dishes.name as dish_name, dishes.price, categories.name as cat_name FROM dishes 
                       JOIN categories ON dishes.category_id = categories.id ORDER BY dishes.id DESC");

// 3. Получение категорий для выпадающего списка
$cat_res = $mysqli->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="<?php echo $language; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo ($language == 'ru' ? 'Управление' : 'Management'); ?></title>
    <style>
        body { background: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>; font-family: sans-serif; padding: 20px; }
        .form-section { border: 1px solid #888; padding: 15px; margin-bottom: 30px; border-radius: 5px; max-width: 400px; }
        table { border-collapse: collapse; width: 100%; color: <?php echo $text_color; ?>; }
        th, td { border: 1px solid #888; padding: 10px; text-align: left; }
        input, select, button { padding: 8px; margin: 5px 0; display: block; width: 100%; box-sizing: border-box; }
        a { color: <?php echo ($theme === 'dark') ? '#4dbaff' : '#007bff'; ?>; }
    </style>
</head>
<body>
    <h1><?php echo ($language == 'ru' ? 'Управление меню ресторана' : 'Menu Management'); ?></h1>
    <p><?php echo ($language == 'ru' ? 'Вы вошли как администратор.' : 'Logged in as administrator.'); ?></p>

    <!-- Форма добавления -->
    <div class="form-section">
        <h3><?php echo ($language == 'ru' ? 'Добавить новое блюдо' : 'Add New Dish'); ?></h3>
        <?php echo $msg; ?>
        <form method="POST">
            <?= ($language == 'ru' ? 'Название' : 'Name') ?>: <input type="text" name="name" required>
            <?= ($language == 'ru' ? 'Цена' : 'Price') ?> ($): <input type="number" step="0.01" name="price" required>
            <?= ($language == 'ru' ? 'Категория' : 'Category') ?>: 
            <select name="category_id">
                <?php while($cat = $cat_res->fetch_assoc()): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" name="add_dish" style="background: #28a745; color: white; border: none; cursor: pointer;"><?= ($language == 'ru' ? 'Добавить' : 'Add') ?></button>
        </form>
    </div>

    <!-- Таблица текущих блюд -->
    <h3><?php echo ($language == 'ru' ? 'Текущее меню' : 'Current Menu'); ?></h3>
    <table>
        <tr>
            <th>ID</th>
            <th><?php echo ($language == 'ru' ? 'Категория' : 'Category'); ?></th>
            <th><?php echo ($language == 'ru' ? 'Название' : 'Name'); ?></th>
            <th><?php echo ($language == 'ru' ? 'Цена' : 'Price'); ?></th>
        </tr>
        <?php while ($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['cat_name']); ?></td>
                <td><?php echo htmlspecialchars($row['dish_name']); ?></td>
                <td><?php echo $row['price']; ?>$</td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br><a href="index.php"><?php echo ($language == 'ru' ? 'На главную' : 'Back Home'); ?></a>
</body>
</html>
