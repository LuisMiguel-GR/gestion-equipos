<?php

require_once  __DIR__ . "/../../app/View.php";

class IndexController {
    public function index() {
        View::render("index", []);
    }

}