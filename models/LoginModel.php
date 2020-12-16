<?php

namespace models;

use core\Application;
use core\DataBase;
use core\Session;
use core\Validation;

class LoginModel
{
    public $email;
    public $pass;

    public function checkSubmit()
    {
        if (isset($_POST['submit'])) {
            return true;
        } else {
            return false;
        }

    }

    public function validate()
    {
        if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pass'])) {
            $this->email = Validation::validateInput($_POST['email']);
            $this->pass = Validation::validateInput($_POST['pass']);

            if (Validation::email($this->email)) {
                $sql = "SELECT * FROM users WHERE email=:email LIMIT 1";
                $value = ['email' => $this->email];
                if ($result = DataBase::$db->prepare($sql, $value)) {

                    foreach ($result as $row) {
                        if (password_verify($this->pass, $row['pass'])) {
                            Session::set('user', $row['name']);
                            Session::set('type', $row['type']);
                            return true;
                        } else {
                            $response = ['error' => "Password is wrong"];
                            Application::$app->router->loadData = $response;
                        }
                    }
                } else {
                    $response = ['error' => "User Not Found"];
                    Application::$app->router->loadData = $response;
                }
            } else {
                $response = ['error' => "Invalid Email"];
                Application::$app->router->loadData = $response;
            }
        } else {
            $response = [
                'error' => 'Empty Field',
                'email' => Validation::validateInput($_POST['email']),
                'pass' => Validation::validateInput($_POST['pass']),
            ];
            Application::$app->router->loadData = $response;
        }
    }

}
