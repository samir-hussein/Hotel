<?php

namespace controllers;

use core\Application;
use core\Session;

class Logout
{
    public function logout()
    {
        Session::remove("user");
        Session::remove("type");
        Application::$app->response->redirect("/admin");
        exit;
    }
}
