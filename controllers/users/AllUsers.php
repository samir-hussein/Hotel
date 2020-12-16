<?php

namespace controllers\users;

use core\Application;
use models\users\AllUsersModel;

class AllUsers
{
    public function allUsers()
    {
        $allusers = new AllUsersModel();
        if ($allusers->checkSubmit()) {
            $allusers->validate();
        }
        $allusers->showAll();
        return Application::$app->router->renderView("/admin/users/allusers.php");
    }
}
