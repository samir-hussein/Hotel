<?php
namespace models\hotel_images;

use core\Application;
use core\DataBase;
use core\Validation;

class AllHotelImagesModel
{

    public function allData()
    {
        $sql = "SELECT * FROM hotel_images";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['allData'] = $response;
        }
    }

    public function checkDelete()
    {
        if (isset($_POST['delete']) && isset($_POST['id']) && !empty($_POST['id'])) {
            $id = Validation::validateInput($_POST['id']);
            $value = ['id' => $id];
            $sql = "SELECT * FROM hotel_images WHERE id=:id";
            if ($result = DataBase::$db->prepare($sql, $value)) {
                foreach ($result as $row) {
                    unlink("assets/images/" . $row['image']);
                }
                $sql = "DELETE FROM hotel_images WHERE id =:id";
                if (DataBase::$db->prepare($sql, $value)) {
                    $response = ['success' => "deleted successfully"];
                    Application::$app->router->loadData = $response;
                }
            }
        }
    }
}
