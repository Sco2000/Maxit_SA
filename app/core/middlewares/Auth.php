<?php
namespace App\core\middlewares;

use App\core\Session;
use App\core\App;

class Auth
{
    

    public function __invoke() {
        $session = App::getDependency('Session');
        if (!$session->get('user') ) {
            header('Location: /');
            exit();
        }
    }
}
