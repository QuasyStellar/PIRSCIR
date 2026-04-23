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
        <form method="POST">
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
    <br><a href="index.php">Back</a>
</body>
</html>
