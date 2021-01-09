<?php
namespace models\room_types;

use core\Application;
use core\DataBase;
use core\Validation;

class AddRoomTypeModel
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
        if (isset($_POST['name']) && isset($_POST['adults']) && isset($_POST['children']) && isset($_POST['Categories']) && isset($_POST['bed_type']) && isset($_POST['cost']) && isset($_POST['facilities']) && !empty($_POST['name']) && !empty($_POST['adults']) && !empty($_POST['Categories']) && !empty($_POST['bed_type']) && !empty($_POST['cost']) && !empty($_POST['facilities']) && isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {

            $name = Validation::validateInput($_POST['name']);
            $sql = "SELECT * FROM rooms_types WHERE name=:name";
            $value = ['name' => $name];

            if (Database::$db->prepare($sql, $value)) {
                $response = ['error' => 'room type is already exist'];
                Application::$app->router->loadData = $response;
            } else {
                $allowEx = ['png', 'jpg', 'jpeg', 'webp'];
                $dir = 'assets/images/';
                $imgName = Validation::file("image", $allowEx, $dir, "room");

                if ($imgName == 2) {
                    $response = ['error' => "Invalid extension allowed (png - jpg - jpeg - webp)"];
                    Application::$app->router->loadData = $response;
                } elseif ($imgName == 3) {
                    $response = ['error' => "Error Uploading image try again"];
                    Application::$app->router->loadData = $response;
                } else {
                    if ($imgName['ext'] != 'webp') {
                        $fileName = $dir . $imgName['name'];
                        $fun = "convert" . $imgName['ext'] . "ToWebp";
                        if (Validation::$fun($fileName)) {
                            unlink($fileName);
                            $imgName['name'] = str_ireplace($imgName['ext'], 'webp', $imgName['name']);
                        }
                    }

                    $adults = Validation::phoneNumber($_POST['adults']);
                    $children = Validation::phoneNumber($_POST['children']);
                    $facilities = Validation::validateInput($_POST['facilities']);
                    $Categories = Validation::validateInput($_POST['Categories']);
                    $bed_type = Validation::validateInput($_POST['bed_type']);
                    $cost = Validation::money($_POST['cost']);

                    $sql = "INSERT INTO rooms_types (image,name,adults,children,facilities,Categories,bed_type,cost) VALUES (:image,:name,:adults,:children,:facilities,:Categories,:bed_type,:cost)";
                    $values = [
                        "image" => $imgName['name'],
                        'name' => $name,
                        'adults' => $adults,
                        'children' => $children,
                        'facilities' => $facilities,
                        'Categories' => $Categories,
                        'bed_type' => $bed_type,
                        'cost' => $cost,
                    ];

                    if (DataBase::$db->prepare($sql, $values)) {
                        $response = ['success' => "added successfully"];
                        Application::$app->router->loadData = $response;
                    } else {
                        $response = ['error' => "Something went wrong"];
                        Application::$app->router->loadData = $response;
                    }
                }
            }
        } else {
            $response = [
                'error' => 'Empty field',
                'name' => Validation::validateInput($_POST['name']),
                'adults' => Validation::phoneNumber($_POST['adults']),
                'children' => Validation::phoneNumber($_POST['children']),
                'facilities' => Validation::validateInput($_POST['facilities']),
                'Categories' => Validation::validateInput($_POST['Categories']),
                'bed_type' => Validation::validateInput($_POST['bed_type']),
                'cost' => Validation::money($_POST['cost']),
            ];
            Application::$app->router->loadData = $response;
        }
    }

    public function checkEdit()
    {
        if (isset($_GET['edit'])) {
            $id = Validation::validateInput($_GET['edit']);
            $value = ['id' => $id];
            $sql = "SELECT * FROM rooms_types WHERE id=:id";
            if ($response = DataBase::$db->prepare($sql, $value)) {
                foreach ($response as $row) {
                    Application::$app->router->loadData['name'] = $row['name'];
                    Application::$app->router->loadData['adults'] = $row['adults'];
                    Application::$app->router->loadData['children'] = $row['children'];
                    Application::$app->router->loadData['facilities'] = $row['facilities'];
                    Application::$app->router->loadData['Categories'] = $row['Categories'];
                    Application::$app->router->loadData['bed_type'] = $row['bed_type'];
                    Application::$app->router->loadData['cost'] = $row['cost'];
                    Application::$app->router->loadData['image'] = $row['image'];
                }
            }
        }
    }

    public function edit()
    {
        if (isset($_POST['edit'])) {
            if (isset($_POST['name']) && isset($_POST['adults']) && isset($_POST['children']) && isset($_POST['Categories']) && isset($_POST['bed_type']) && isset($_POST['cost']) && isset($_POST['facilities']) && !empty($_POST['name']) && !empty($_POST['adults']) && !empty($_POST['children']) && !empty($_POST['Categories']) && !empty($_POST['bed_type']) && !empty($_POST['cost']) && !empty($_POST['facilities'])) {
                $name = Validation::validateInput($_POST['name']);
                $adults = Validation::phoneNumber($_POST['adults']);
                $children = Validation::phoneNumber($_POST['children']);
                $facilities = Validation::validateInput($_POST['facilities']);
                $Categories = Validation::validateInput($_POST['Categories']);
                $bed_type = Validation::validateInput($_POST['bed_type']);
                $cost = Validation::money($_POST['cost']);
                $id = Validation::validateInput($_POST['id']);

                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $editImage = Validation::validateInput($_POST['editImage']);
                    unlink("assets/images/$editImage");
                    $allowEx = ['png', 'jpg', 'jpeg', 'webp'];
                    $dir = 'assets/images/';
                    $imgName = Validation::file("image", $allowEx, $dir, "room");

                    if ($imgName == 2) {
                        $response = ['error' => "Invalid extension allowed (png - jpg - jpeg - webp)"];
                        Application::$app->router->loadData = $response;
                    } elseif ($imgName == 3) {
                        $response = ['error' => "Error Uploading image try again"];
                        Application::$app->router->loadData = $response;
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
                            'adults' => $adults,
                            'children' => $children,
                            'facilities' => $facilities,
                            'Categories' => $Categories,
                            'bed_type' => $bed_type,
                            'cost' => $cost,
                            'id' => $id,
                        ];
                        $sql = "UPDATE rooms_types SET image=:image, name=:name, adults=:adults,children=:children, facilities=:facilities, Categories=:Categories, bed_type=:bed_type, cost=:cost WHERE id=:id";

                        if (DataBase::$db->prepare($sql, $values)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    $sql = "UPDATE rooms_types SET name=:name, adults=:adults,children=:children, facilities=:facilities, Categories=:Categories, bed_type=:bed_type, cost=:cost WHERE id=:id";
                    $values = [
                        'name' => $name,
                        'adults' => $adults,
                        'children' => $children,
                        'facilities' => $facilities,
                        'Categories' => $Categories,
                        'bed_type' => $bed_type,
                        'cost' => $cost,
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
                    'adults' => Validation::phoneNumber($_POST['adults']),
                    'children' => Validation::phoneNumber($_POST['children']),
                    'facilities' => Validation::validateInput($_POST['facilities']),
                    'Categories' => Validation::validateInput($_POST['Categories']),
                    'bed_type' => Validation::validateInput($_POST['bed_type']),
                    'cost' => Validation::money($_POST['cost']),
                    'image' => Validation::validateInput($_POST['editImage']),
                ];
                Application::$app->router->loadData = $response;
            }
        }
    }
}
