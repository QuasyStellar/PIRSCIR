<?php
require_once 'vendor/autoload.php';

use App\Controllers\MenuController;

$controller = new MenuController();
$controller->index();
