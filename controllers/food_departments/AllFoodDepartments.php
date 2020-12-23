<?php
namespace controllers\food_departments;

use core\Application;
use models\food_departments\AllFoodDepartmentsModel;

class AllFoodDepartments
{

    public function all()
    {

        $all = new AllFoodDepartmentsModel();

        $all->checkDelete();
        $all->allData();

        Application::$app->router->renderView('/admin/food_departments/all.php');
    }
}
