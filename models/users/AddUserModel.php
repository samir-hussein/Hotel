<?php

namespace models\users;

use core\Application;
use core\DataBase;
use core\Validation;

class AddUserModel
{
    public $name;
    public $email;
    public $pass;
    public $checkbox;

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
        if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pass']) && isset($_POST['checkbox']) && !empty($_POST['checkbox'])) {
            $this->name = Validation::validateInput($_POST['name']);
            $this->email = Validation::validateInput($_POST['email']);
            $this->pass = Validation::validateInput($_POST['pass']);
            $this->checkbox = Validation::validateInput($_POST['checkbox']);

            if (Validation::email($this->email)) {
                $sql = "SELECT * FROM users WHERE email=:email";
                $value = ['email' => $this->email];
                if (DataBase::$db->prepare($sql, $value)) {
                    $response = [
                        'error' => "Email is already exist",
                        'name' => Validation::validateInput($_POST['name']),
                        'email' => Validation::validateInput($_POST['email']),
                        'pass' => Validation::validateInput($_POST['pass']),
                        'checkbox' => (isset($_POST['checkbox'])) ? Validation::validateInput($_POST['checkbox']) : "",
                    ];
                    Application::$app->router->loadData = $response;
                } else {
                    $this->pass = password_hash($this->pass, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users (name,email,pass,type) VALUES (:name,:email,:pass,:type)";
                    $values = [
                        'name' => $this->name,
                        'email' => $this->email,
                        'pass' => $this->pass,
                        'type' => $this->checkbox,
                    ];
                    if (DataBase::$db->prepare($sql, $values)) {
                        $response = ['success' => "user added successfully"];
                        Application::$app->router->loadData = $response;
                    } else {
                        $response = ['error' => "Something went wrong"];
                        Application::$app->router->loadData = $response;
                    }
                }
            } else {
                $response = [
                    'error' => "Invalid Email",
                    'name' => Validation::validateInput($_POST['name']),
                    'email' => Validation::validateInput($_POST['email']),
                    'pass' => Validation::validateInput($_POST['pass']),
                    'checkbox' => (isset($_POST['checkbox'])) ? Validation::validateInput($_POST['checkbox']) : "",
                ];
                Application::$app->router->loadData = $response;
            }

        } else {
            $response = [
                'name' => Validation::validateInput($_POST['name']),
                'email' => Validation::validateInput($_POST['email']),
                'pass' => Validation::validateInput($_POST['pass']),
                'checkbox' => (isset($_POST['checkbox'])) ? Validation::validateInput($_POST['checkbox']) : "",
                'error' => "Empty Field",
            ];
            Application::$app->router->loadData = $response;
        }
    }
}
