<?php
namespace App\Controllers;

use App\Models\Statistic;

class HomeController extends BaseController {
    public function index() {
        $stats_count = Statistic::count();
        $this->render('home', ['stats_count' => $stats_count]);
    }
}
