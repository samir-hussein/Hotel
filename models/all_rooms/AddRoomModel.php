<?php
namespace models\all_rooms;

use core\Application;
use core\DataBase;
use core\Validation;

class AddRoomModel
{

    public function allTypes()
    {
        $sql = "SELECT * FROM rooms_types";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['types'] = $response;
        }
    }

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
        if (isset($_POST['name']) && isset($_POST['type']) && !empty($_POST['name']) && !empty($_POST['type'])) {

            $name = Validation::validateInput($_POST['name']);
            $type = Validation::validateInput($_POST['type']);

            $sql = "INSERT INTO all_rooms (name, type) VALUES (:name, :type)";
            $values = [
                'name' => $name,
                'type' => $type,
            ];
            if (DataBase::$db->prepare($sql, $values)) {
                $response = ['success' => "added successfully"];
                Application::$app->router->loadData['allInputs'] = $response;
            } else {
                $response = ['error' => "something went wrong, please try again"];
                Application::$app->router->loadData['allInputs'] = $response;
            }

        } else {
            $response = [
                'error' => 'Empty Field',
                'name' => Validation::validateInput($_POST['name']),
                'type' => Validation::validateInput($_POST['type']),
            ];
            Application::$app->router->loadData['allInputs'] = $response;
        }
    }

    public function checkEdit()
    {
        if (isset($_GET['edit'])) {
            $id = Validation::validateInput($_GET['edit']);
            $value = ['id' => $id];
            $sql = "SELECT * FROM all_rooms WHERE id=:id";
            if ($response = DataBase::$db->prepare($sql, $value)) {
                foreach ($response as $row) {
                    Application::$app->router->loadData['allInputs']['name'] = $row['name'];
                    Application::$app->router->loadData['allInputs']['type'] = $row['type'];
                }
            }
        }
    }

    public function edit()
    {
        if (isset($_POST['edit'])) {
            if (isset($_POST['name']) && isset($_POST['type']) && !empty($_POST['name']) && !empty($_POST['type'])) {
                $name = Validation::validateInput($_POST['name']);
                $type = Validation::validateInput($_POST['type']);
                $id = Validation::validateInput($_POST['id']);

                $sql = "UPDATE all_rooms SET name=:name, type=:type WHERE id=:id";
                $values = [
                    'name' => $name,
                    'type' => $type,
                    'id' => $id,
                ];

                if (DataBase::$db->prepare($sql, $values)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $response = [
                    'error' => 'Empty Field',
                    'name' => Validation::validateInput($_POST['name']),
                    'type' => Validation::validateInput($_POST['type']),
                ];
                Application::$app->router->loadData['allInputs'] = $response;
            }
        }
    }
}
