<?php

namespace App\core;

class ErrorController {
    public function error404() {
        require_once "../app/config/error/error.html";
    }
}