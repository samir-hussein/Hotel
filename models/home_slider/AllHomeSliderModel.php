<?php
namespace models\home_slider;

use core\Application;
use core\DataBase;
use core\Validation;

class AllHomeSliderModel
{

    public function allData()
    {
        $sql = "SELECT * FROM home_slider";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['allData'] = $response;
        }
    }

    public function checkDelete()
    {
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $id = Validation::validateInput($_POST['id']);
            $value = [
                'id' => $id,
            ];
            $sql = "SELECT * FROM home_slider WHERE id=:id";
            if ($result = DataBase::$db->prepare($sql, $value)) {
                foreach ($result as $row) {
                    unlink("assets/images/" . $row['image']);
                }
                $sql = "DELETE FROM home_slider WHERE id=:id";

                if (DataBase::$db->prepare($sql, $value)) {
                    Application::$app->router->loadData['success'] = 'deleted successfully';
                }
            }
        }
    }
}
