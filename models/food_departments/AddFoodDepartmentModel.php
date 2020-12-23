<?php
namespace models\food_departments;

use core\Application;
use core\DataBase;
use core\Validation;

class AddFoodDepartmentModel
{

    public function checkSubmit()
    {
        if (isset($_POST['add'])) {
            return true;
        } else {
            return false;
        }
    }

    public function validate()
    {
        if (isset($_POST['type']) && !empty($_POST['type'])) {

            $type = Validation::validateInput($_POST['type']);
            $sql = "INSERT INTO food_departments (type) VALUES (:type)";
            $values = [
                'type' => $type,
            ];

            if (DataBase::$db->prepare($sql, $values)) {
                $response = ['success' => "added successfully"];
                Application::$app->router->loadData = $response;
            } else {
                $response = ['error' => "Something went wrong"];
                Application::$app->router->loadData = $response;
            }
        } else {
            $response = [
                'error' => 'Empty field',
                'type' => Validation::validateInput($_POST['type']),
            ];
            Application::$app->router->loadData = $response;
        }
    }
}
