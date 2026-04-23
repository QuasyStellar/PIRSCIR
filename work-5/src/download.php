<?php
// download.php
$mysqli = new mysqli("db", "user", "password", "restaurant_db");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $mysqli->prepare("SELECT filename, content FROM pdfs WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($filename, $content);
    
    if ($stmt->fetch()) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=\"$filename\"");
        echo $content;
        exit;
    }
    $stmt->close();
}
echo "Файл не найден.";
?>
