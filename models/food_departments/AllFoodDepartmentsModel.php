<?php
namespace models\food_departments;

use core\Application;
use core\DataBase;
use core\Validation;

class AllFoodDepartmentsModel
{

    public function allData()
    {
        $sql = "SELECT * FROM food_departments";
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
            $sql = "DELETE FROM food_departments WHERE id=:id";
            if (DataBase::$db->prepare($sql, $value)) {
                Application::$app->router->loadData['success'] = 'deleted successfully';
            }
        }
    }
}
