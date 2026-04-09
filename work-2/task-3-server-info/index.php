<?php
require_once 'server_utils.php';

$whoami_info = getWhoami();
$id_info = getId();
$processes_info = getRunningProcesses();
$current_dir_listing = getDirectoryListing('/var/www/html/task-3-server-info');
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Информация о сервере</title></head>
<body>
    <h1>Информация о сервере</h1>
    
    <h3>Пользователь (whoami)</h3>
    <pre><?php echo htmlspecialchars($whoami_info); ?></pre>

    <h3>Идентификаторы (id)</h3>
    <pre><?php echo htmlspecialchars($id_info); ?></pre>

    <h3>Процессы (ps aux)</h3>
    <pre><?php echo htmlspecialchars($processes_info); ?></pre>

    <h3>Директория (ls -la)</h3>
    <pre><?php echo htmlspecialchars($current_dir_listing); ?></pre>

    <br><a href="/index.php">Назад на главную</a>
</body>
</html>
