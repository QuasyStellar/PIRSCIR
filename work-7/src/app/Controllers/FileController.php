<?php
namespace App\Controllers;

use App\Models\PdfFile;
use App\Core\Auth;

class FileController extends BaseController {
    public function index() {
        Auth::requireAuth();
        $files = PdfFile::getAll();
        $this->render('upload', ['files' => $files]);
    }

    public function upload() {
        Auth::requireAuth();
        if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
            $filename = $_FILES['pdf_file']['name'];
            $target = 'uploads/' . basename($filename);
            if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $target)) {
                PdfFile::add($filename);
            }
        }
        header("Location: index.php?action=files");
    }

    public function download() {
        $id = intval($_GET['id'] ?? 0);
        $file = PdfFile::getById($id);
        if ($file) {
            header("Content-Type: application/pdf");
            header("Content-Disposition: attachment; filename=\"" . $file['filename'] . "\"");
            echo $file['content'];
        } else {
            die("File not found");
        }
    }

    public function delete() {
        Auth::requireAuth();
        $id = intval($_GET['id'] ?? 0);
        PdfFile::delete($id);
        header("Location: index.php?action=files");
    }
}
