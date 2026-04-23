<?php
require_once 'personalization.php';
$mysqli = new \mysqli("db", "user", "password", "restaurant_db");
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf_file'])) {
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
    $file_name = basename($_FILES["pdf_file"]["name"]);
    $target_file = $target_dir . $file_name;
    
    if (pathinfo($target_file, PATHINFO_EXTENSION) != "pdf") {
        $message = ($language == 'ru' ? "Ошибка: Только PDF файлы!" : "Error: Only PDF files allowed!");
    } else {
        if (move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $target_file)) {
            $stmt = $mysqli->prepare("INSERT INTO menu_files (filename) VALUES (?)");
            $stmt->bind_param("s", $file_name);
            $stmt->execute();
            $message = ($language == 'ru' ? "Файл загружен!" : "File uploaded successfully!");
        } else {
            $message = ($language == 'ru' ? "Ошибка загрузки." : "Upload error.");
        }
    }
}

$files = $mysqli->query("SELECT * FROM menu_files")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<head>
    <meta charset="UTF-8">
    <title><?= ($language == 'ru' ? 'Загрузка PDF' : 'PDF Upload') ?></title>
    <style>
        body { background: <?= $bg_color ?>; color: <?= $text_color ?>; font-family: sans-serif; padding: 20px; }
        .file-list { margin-top: 20px; border-top: 1px solid #ccc; padding-top: 10px; }
    </style>
</head>
<body>
    <h1><?= ($language == 'ru' ? 'Управление файлами меню' : 'Menu File Management') ?></h1>
    <?php if ($message): ?><p><strong><?= $message ?></strong></p><?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="pdf_file" required>
        <button type="submit"><?= ($language == 'ru' ? 'Загрузить PDF' : 'Upload PDF') ?></button>
    </form>

    <div class="file-list">
        <h3><?= ($language == 'ru' ? 'Список загруженных меню' : 'Uploaded Menu List') ?></h3>
        <ul>
            <?php foreach ($files as $file): ?>
                <li>
                    <?= htmlspecialchars($file['filename']) ?> 
                    (<a href="download.php?id=<?= $file['id'] ?>" style="color:<?= $text_color ?>"><?= ($language == 'ru' ? 'Скачать' : 'Download') ?></a> | 
                     <a href="delete_pdf.php?id=<?= $file['id'] ?>" style="color:<?= $text_color ?>"><?= ($language == 'ru' ? 'Удалить' : 'Delete') ?></a>)
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <br><a href="index.php" style="color:<?= $text_color ?>"><?= ($language == 'ru' ? 'Назад' : 'Back') ?></a>
</body>
</html>
