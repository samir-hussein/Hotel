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
