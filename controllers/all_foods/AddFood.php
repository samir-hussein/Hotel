<?php
namespace controllers\all_foods;

use core\Application;
use models\all_foods\AddFoodModel;

class AddFood
{

    public function add()
    {

        $add = new AddFoodModel();
        $add->allDepartments();

        if ($add->checkSubmit()) {
            $add->validate();
        }

        $add->checkEdit();
        if ($add->edit()) {
            Application::$app->response->redirect('/admin/all_foods?success');
        }
        Application::$app->router->renderView('/admin/all_foods/add.php');
    }
}
