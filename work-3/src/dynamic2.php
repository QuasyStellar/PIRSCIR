<?php
header('Content-Type: text/html; charset=UTF-8');
require_once 'auth.php';
$mysqli = require_auth();

$res = $mysqli->query("SELECT dishes.id, dishes.name as dish_name, dishes.price, categories.name as cat_name FROM dishes JOIN categories ON dishes.category_id = categories.id");
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Админка</title></head>
<body>
    <h1>Администрирование меню</h1>
    <p>Вы успешно авторизовались как администратор.</p>
    <table border="1">
        <tr><th>ID</th><th>Категория</th><th>Блюдо</th><th>Цена</th></tr>
        <?php while($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['cat_name']; ?></td>
                <td><?php echo $row['dish_name']; ?></td>
                <td><?php echo $row['price']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br><a href="index.php">На главную</a>
</body>
</html>
