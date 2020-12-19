<?php

namespace models\home_slider;

use core\Application;
use core\DataBase;
use core\Validation;

class AddHomeSliderModel
{

    public function checkSubmit()
    {
        if (isset($_POST['add'])) {
            return true;
        } else {
            return false;
        }
    }

    public function checkEdit()
    {
        if (isset($_GET['edit'])) {
            $id = Validation::validateInput($_GET['edit']);
            $value = ['id' => $id];
            $sql = "SELECT * FROM home_slider WHERE id=:id";
            if ($response = DataBase::$db->prepare($sql, $value)) {
                foreach ($response as $row) {
                    Application::$app->router->loadData['h'] = $row['h'];
                    Application::$app->router->loadData['p'] = $row['p'];
                    Application::$app->router->loadData['image'] = $row['image'];
                }
            }
        }
    }

    public function edit()
    {
        if (isset($_POST['edit'])) {
            if (isset($_POST['h']) && isset($_POST['p']) && !empty($_POST['h']) && !empty($_POST['p']) && isset($_POST['id']) && !empty($_POST['id'])) {
                $h = Validation::validateInput($_POST['h']);
                $p = Validation::validateInput($_POST['p']);
                $id = Validation::validateInput($_POST['id']);

                if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
                    $editImage = Validation::validateInput($_POST['editImage']);
                    unlink("assets/images/$editImage");
                    $allowEx = ['png', 'jpg', 'jpeg', 'webp'];
                    $dir = 'assets/images/';
                    $imgName = Validation::file("image", $allowEx, $dir, "home_slider");

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
                            'h' => $h,
                            'p' => $p,
                            'id' => $id,
                        ];
                        $sql = "UPDATE home_slider SET image=:image, h=:h, p=:p WHERE id=:id";

                        if (DataBase::$db->prepare($sql, $values)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    $sql = "UPDATE home_slider SET h=:h, p=:p WHERE id=:id";
                    $values = [
                        'h' => $h,
                        'p' => $p,
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
                    'h' => Validation::validateInput($_POST['h']),
                    'p' => Validation::validateInput($_POST['p']),
                    'image' => Validation::validateInput($_POST['editImage']),
                ];
                Application::$app->router->loadData = $response;
            }
        }
    }

    public function validate()
    {
        if (isset($_POST['h']) && isset($_POST['p']) && !empty($_POST['h']) && !empty($_POST['p']) && isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {

            $allowEx = ['png', 'jpg', 'jpeg', 'webp'];
            $dir = 'assets/images/';
            $imgName = Validation::file("image", $allowEx, $dir, "home_slider");

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

                $h = Validation::validateInput($_POST['h']);
                $p = Validation::validateInput($_POST['p']);

                $sql = "INSERT INTO home_slider (image,h,p) VALUES (:image,:h,:p)";
                $values = [
                    "image" => $imgName['name'],
                    'h' => $h,
                    'p' => $p,
                ];

                if (DataBase::$db->prepare($sql, $values)) {
                    $response = ['success' => "added successfully"];
                    Application::$app->router->loadData = $response;
                } else {
                    $response = ['error' => "Something went wrong"];
                    Application::$app->router->loadData = $response;
                }
            }
        } else {
            $response = [
                'error' => 'Empty field',
                'h' => Validation::validateInput($_POST['h']),
                'p' => Validation::validateInput($_POST['p']),
            ];
            Application::$app->router->loadData = $response;
        }
    }
}
