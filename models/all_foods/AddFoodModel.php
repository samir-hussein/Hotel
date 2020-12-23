<?php
namespace models\all_foods;

use core\Application;
use core\DataBase;
use core\Validation;

class AddFoodModel
{

    public function allDepartments()
    {
        $sql = "SELECT * FROM food_departments";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['departments'] = $response;
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
        if (isset($_POST['name']) && isset($_POST['type']) && isset($_POST['details']) && isset($_POST['price']) && !empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['price']) && !empty($_POST['details']) && isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {

            $allowEx = ['png', 'jpg', 'jpeg', 'webp'];
            $dir = 'assets/images/';
            $imgName = Validation::file("image", $allowEx, $dir, "food");

            if ($imgName == 2) {
                $response = ['error' => "Invalid extension allowed (png - jpg - jpeg - webp)"];
                Application::$app->router->loadData['allInputs'] = $response;
            } elseif ($imgName == 3) {
                $response = ['error' => "Error Uploading image try again"];
                Application::$app->router->loadData['allInputs'] = $response;
            } else {

                if ($imgName['ext'] != 'webp') {
                    $fileName = $dir . $imgName['name'];
                    $fun = "convert" . $imgName['ext'] . "ToWebp";
                    if (Validation::$fun($fileName)) {
                        unlink($fileName);
                        $imgName['name'] = str_ireplace($imgName['ext'], 'webp', $imgName['name']);
                    }
                }

                $name = Validation::validateInput($_POST['name']);
                $type = Validation::validateInput($_POST['type']);
                $price = Validation::money($_POST['price']);
                $details = Validation::validateInput($_POST['details']);

                $sql = "INSERT INTO all_foods (image,name,price,type,details) VALUES (:image,:name,:price,:type,:details)";
                $values = [
                    "image" => $imgName['name'],
                    'name' => $name,
                    'type' => $type,
                    'price' => $price,
                    'details' => $details,
                ];

                if (DataBase::$db->prepare($sql, $values)) {
                    $response = ['success' => "added successfully"];
                    Application::$app->router->loadData['allInputs'] = $response;
                } else {
                    $response = ['error' => "Something went wrong"];
                    Application::$app->router->loadData['allInputs'] = $response;
                }
            }
        } else {
            $response = [
                'error' => 'Empty field',
                'name' => Validation::validateInput($_POST['name']),
                'price' => Validation::money($_POST['price']),
                'type' => Validation::validateInput($_POST['type']),
                'details' => Validation::validateInput($_POST['details']),
            ];
            Application::$app->router->loadData['allInputs'] = $response;
        }
    }

    public function checkEdit()
    {
        if (isset($_GET['edit'])) {
            $id = Validation::validateInput($_GET['edit']);
            $value = ['id' => $id];
            $sql = "SELECT * FROM all_foods WHERE id=:id";
            if ($response = DataBase::$db->prepare($sql, $value)) {
                foreach ($response as $row) {
                    Application::$app->router->loadData['allInputs']['name'] = $row['name'];
                    Application::$app->router->loadData['allInputs']['type'] = $row['type'];
                    Application::$app->router->loadData['allInputs']['price'] = $row['price'];
                    Application::$app->router->loadData['allInputs']['details'] = $row['details'];
                    Application::$app->router->loadData['allInputs']['image'] = $row['image'];
                }
            }
        }
    }

    public function edit()
    {
        if (isset($_POST['edit'])) {
            if (isset($_POST['name']) && isset($_POST['type']) && isset($_POST['details']) && isset($_POST['price']) && !empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['price']) && !empty($_POST['details'])) {
                $name = Validation::validateInput($_POST['name']);
                $type = Validation::validateInput($_POST['type']);
                $price = Validation::money($_POST['price']);
                $details = Validation::validateInput($_POST['details']);
                $id = Validation::validateInput($_POST['id']);

                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $editImage = Validation::validateInput($_POST['editImage']);
                    unlink("assets/images/$editImage");
                    $allowEx = ['png', 'jpg', 'jpeg', 'webp'];
                    $dir = 'assets/images/';
                    $imgName = Validation::file("image", $allowEx, $dir, "food");

                    if ($imgName == 2) {
                        $response = ['error' => "Invalid extension allowed (png - jpg - jpeg - webp)"];
                        Application::$app->router->loadData['allInputs'] = $response;
                    } elseif ($imgName == 3) {
                        $response = ['error' => "Error Uploading image try again"];
                        Application::$app->router->loadData['allInputs'] = $response;
                    } else {
                        if ($imgName['ext'] != 'webp') {
                            $fileName = $dir . $imgName['name'];
                            $fun = "convert" . $imgName['ext'] . "ToWebp";
                            if (Validation::$fun($fileName)) {
                                unlink($fileName);
                                $imgName['name'] = str_ireplace($imgName['ext'], 'webp', $imgName['name']);
                            }
                        }

                        $values = [
                            "image" => $imgName['name'],
                            'name' => $name,
                            'type' => $type,
                            'price' => $price,
                            'details' => $details,
                            'id' => $id,
                        ];
                        $sql = "UPDATE all_foods SET image=:image, name=:name, price=:price, type=:type, details=:details WHERE id=:id";

                        if (DataBase::$db->prepare($sql, $values)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    $sql = "UPDATE all_foods SET name=:name, price=:price, type=:type, details=:details WHERE id=:id";
                    $values = [
                        'name' => $name,
                        'type' => $type,
                        'price' => $price,
                        'details' => $details,
                        'id' => $id,
                    ];

                    if (DataBase::$db->prepare($sql, $values)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                $response = [
                    'error' => 'Empty field',
                    'name' => Validation::validateInput($_POST['name']),
                    'price' => Validation::money($_POST['price']),
                    'type' => Validation::validateInput($_POST['type']),
                    'details' => Validation::validateInput($_POST['details']),
                    'image' => Validation::validateInput($_POST['editImage']),
                ];
                Application::$app->router->loadData['allInputs'] = $response;
            }
        }
    }

}
