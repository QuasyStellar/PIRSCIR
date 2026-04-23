<?php
require_once 'vendor/autoload.php';
use App\Controllers\AdminController;

$controller = new AdminController();
$controller->index();
