<?php
namespace App\Controllers;

class PageController extends BaseController {
    public function about() {
        $this->render('static1');
    }

    public function contacts() {
        $this->render('static2');
    }
}
