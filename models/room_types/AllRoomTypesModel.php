<?php
namespace models\room_types;

use core\Application;
use core\DataBase;
use core\Validation;

class AllRoomTypesModel
{

    public function allData()
    {
        $sql = "SELECT * FROM rooms_types";
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
            $sql = "SELECT * FROM rooms_types WHERE id=:id";
            if ($result = DataBase::$db->prepare($sql, $value)) {
                foreach ($result as $row) {
                    unlink("assets/images/" . $row['image']);
                }
                $sql = "DELETE FROM rooms_types WHERE id=:id";

                if (DataBase::$db->prepare($sql, $value)) {
                    Application::$app->router->loadData['success'] = 'deleted successfully';
                }
            }
        }
    }
}
