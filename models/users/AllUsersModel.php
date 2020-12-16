<?php

namespace models\users;

use core\Application;
use core\DataBase;
use core\Validation;

class AllUsersModel
{
    public function showAll()
    {
        $sql = "SELECT * FROM users";
        if ($result = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['table'] = $result;
        }
    }

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
        if (isset($_POST['delete']) && !empty($_POST['delete'])) {

            $delete = Validation::validateInput($_POST['delete']);
            $sql = "DELETE FROM users WHERE id=:id";
            $value = ['id' => $delete];
            if (DataBase::$db->prepare($sql, $value)) {
                $response = ['success' => "User Deleted Successfully"];
                Application::$app->router->loadData['msg'] = $response;
            }
        }
    }
}
