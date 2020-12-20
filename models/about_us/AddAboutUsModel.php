<?php
namespace models\about_us;

use core\Application;
use core\DataBase;
use core\Validation;

class AddAboutUsModel
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
        if (isset($_POST['p']) && !empty($_POST['p']) && isset($_FILES['video']['name']) && !empty($_FILES['video']['name'])) {

            $allowEx = ['mp4', 'avi', 'webm', 'mkv'];
            $dir = 'assets/videos/';
            $vedioName = Validation::file("video", $allowEx, $dir, "video_about_us");

            if ($vedioName == 1) {
                $response = ['error' => "Error Uploading video"];
                Application::$app->router->loadData = $response;
            } elseif ($vedioName == 2) {
                $response = ['error' => "Invalid extension allowed (mp4 - avi - mkv - webm)"];
                Application::$app->router->loadData = $response;
            } elseif ($vedioName == 3) {
                $response = ['error' => "Error Uploading video try again"];
                Application::$app->router->loadData = $response;
            } else {

                $p = Validation::validateInput($_POST['p']);

                $sql = "INSERT INTO about_us (vedio,p) VALUES (:vedio,:p)";
                $values = [
                    "vedio" => $vedioName['name'],
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
                'p' => Validation::validateInput($_POST['p']),
            ];
            Application::$app->router->loadData = $response;
        }
    }

    public function checkEdit()
    {
        if (isset($_GET['edit'])) {
            $id = Validation::validateInput($_GET['edit']);
            $value = ['id' => $id];
            $sql = "SELECT * FROM about_us WHERE id=:id";
            if ($response = DataBase::$db->prepare($sql, $value)) {
                foreach ($response as $row) {
                    Application::$app->router->loadData['p'] = $row['p'];
                    Application::$app->router->loadData['video'] = $row['vedio'];
                }
            }
        }
    }

    public function edit()
    {
        if (isset($_POST['edit'])) {
            if (isset($_POST['p']) && !empty($_POST['p']) && isset($_POST['id']) && !empty($_POST['id'])) {

                $p = Validation::validateInput($_POST['p']);
                $id = Validation::validateInput($_POST['id']);

                if (isset($_FILES['video']['name']) && !empty($_FILES['video']['name'])) {
                    $editVideo = Validation::validateInput($_POST['editVideo']);
                    unlink("assets/videos/$editVideo");
                    $allowEx = ['mp4', 'avi', 'webm', 'mkv'];
                    $dir = 'assets/videos/';
                    $videoName = Validation::file("video", $allowEx, $dir, "video_about_us");

                    if ($videoName == 2) {
                        $response = ['error' => "Invalid extension allowed (mp4 - mkv - avi - webm)"];
                        Application::$app->router->loadData = $response;
                    } elseif ($videoName == 3) {
                        $response = ['error' => "Error Uploading video try again"];
                        Application::$app->router->loadData = $response;
                    } else {

                        $values = [
                            "video" => $videoName['name'],
                            'p' => $p,
                            'id' => $id,
                        ];
                        $sql = "UPDATE about_us SET vedio=:video, p=:p WHERE id=:id";

                        if (DataBase::$db->prepare($sql, $values)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    $sql = "UPDATE about_us SET p=:p WHERE id=:id";
                    $values = [
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
                    'p' => Validation::validateInput($_POST['p']),
                    'video' => Validation::validateInput($_POST['editVideo']),
                ];
                Application::$app->router->loadData = $response;
            }
        }
    }
}
