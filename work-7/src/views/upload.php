<!DOCTYPE html>
<html lang="<?= $language ?>">
<head><meta charset="UTF-8"><title><?= ($language=='ru'?'Загрузка PDF':'Upload PDF') ?></title>
<style>body { background: <?= $bg_color ?>; color: <?= $text_color ?>; font-family: sans-serif; padding: 20px; }</style></head>
<body>
    <h2><?= ($language=='ru'?'Управление PDF-меню':'PDF Menu Management') ?></h2>
    <form action="index.php?action=upload_file" method="post" enctype="multipart/form-data">
        <input type="file" name="pdf_file" accept=".pdf">
        <button type="submit"><?= ($language=='ru'?'Загрузить':'Upload') ?></button>
    </form>
    <h3><?= ($language=='ru'?'Список файлов':'File List') ?></h3>
    <ul>
        <?php foreach ($files as $file): ?>
            <li>
                <?= htmlspecialchars($file['filename']) ?> 
                <a href="index.php?action=download_file&id=<?= $file['id'] ?>" style="color: <?= $text_color ?>">[<?= ($language=='ru'?'Скачать':'Download') ?>]</a>
                <a href="index.php?action=delete_file&id=<?= $file['id'] ?>" style="color: red">[<?= ($language=='ru'?'Удалить':'Delete') ?>]</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <br><a href="index.php" style="color: <?= $text_color ?>"><?= ($language=='ru'?'На главную':'Back Home') ?></a>
</body></html>
