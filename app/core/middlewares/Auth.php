<?php
namespace App\core\middlewares;

use App\core\Session;
use App\core\App;

class Auth
{
    

    public function __invoke() {
        $session = Session::getInstance();
        if (!$session->get('user') ) {
            header('Location: /');
            exit();
        }
    }
}
