<?php
namespace controllers\food_departments;

use core\Application;
use models\food_departments\AddFoodDepartmentModel;

class AddFoodDepartment
{

    public function add()
    {

        $add = new AddFoodDepartmentModel();
        if ($add->checkSubmit()) {
            $add->validate();
        }

        Application::$app->router->renderView('/admin/food_departments/add.php');
    }
}
