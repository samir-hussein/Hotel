<?php

namespace controllers\users;

use core\Application;
use models\users\AddUserModel;

class AddUser
{
    public function add()
    {
        $login = new AddUserModel();

        if ($login->checkSubmit()) {
            $login->validate();
        }

        return Application::$app->router->renderView("/admin/users/adduser.php");
    }
}
