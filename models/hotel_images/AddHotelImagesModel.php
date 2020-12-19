<?php
namespace models\hotel_images;

use core\Application;
use core\Database;
use core\Validation;

class AddHotelImagesModel
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
        if (isset($_FILES['images']['name'][0]) && !empty($_FILES['images']['name'][0])) {
            $images = [];
            $allowEx = ['png', 'jpg', 'jpeg', 'webp'];
            $dir = 'assets/images/';
            $imgName = Validation::files("images", $allowEx, $dir, "hotel_images");

            if ($imgName == 2) {
                $response = ['error' => "Invalid extension allowed (png - jpg - jpeg - webp)"];
                Application::$app->router->loadData = $response;
            } elseif ($imgName == 3) {
                $response = ['error' => "Error Uploading image try again"];
                Application::$app->router->loadData = $response;
            } else {
                for ($i = 0; $i < count($imgName); $i++) {
                    if ($imgName[$i]['ext'] != 'webp') {
                        $fileName = $dir . $imgName[$i]['name'];
                        $fun = "convert" . $imgName[$i]['ext'] . "ToWebp";
                        if (Validation::$fun($fileName)) {
                            unlink($fileName);
                            $imgName[$i]['name'] = str_ireplace($imgName[$i]['ext'], 'webp', $imgName[$i]['name']);
                        }
                    }
                    $images[] = $imgName[$i]['name'];
                }
                $response = ['success' => 'added successfully'];
                for ($i = 0; $i < count($images); $i++) {
                    $sql = "INSERT INTO hotel_images (image) VALUES (:image)";
                    $value = ['image' => $images[$i]];
                    if (DataBase::$db->prepare($sql, $value)) {
                        Application::$app->router->loadData = $response;
                    } else {
                        $response = ['error' => "error in image number " . ($i + 1)];
                        Application::$app->router->loadData = $response;
                    }
                }
            }
        } else {
            $response = ['error' => 'empty field'];
            Application::$app->router->loadData = $response;
        }
    }
}
