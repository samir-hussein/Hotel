<?php

namespace controllers;

use core\Application;
use models\LoginModel;

class Login
{
    public function login()
    {
        Application::$app->router->layout = "loginlayout.php";
        $login = new LoginModel();

        if ($login->checkSubmit()) {
            if ($login->validate()) {
                Application::$app->response->redirect('/admin/home');
                exit;
            }
        }
        return Application::$app->router->renderView('/admin/login.php');
    }
}
