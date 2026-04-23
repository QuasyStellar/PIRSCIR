<?php
namespace App\Models;

class PdfFile {
    public static function getAll() {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM menu_files")->fetch_all(MYSQLI_ASSOC);
    }

    public static function add($filename) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO menu_files (filename) VALUES (?)");
        $stmt->bind_param("s", $filename);
        return $stmt->execute();
    }

    public static function delete($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM menu_files WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function getById($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT filename, content FROM pdfs WHERE id = ?"); // Обратите внимание на имя таблицы в старом download.php было pdfs, а в upload.php menu_files. Проверю.
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
