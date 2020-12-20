<?php
namespace controllers\about_us;

use core\Application;
use models\about_us\AddAboutUsModel;

class AddAboutUs
{

    public function add()
    {
        $add = new AddAboutUsModel();

        if ($add->checkSubmit()) {
            $add->validate();
        }

        $add->checkEdit();
        if ($add->edit()) {
            Application::$app->response->redirect('/admin/all_about_us?success');
        }

        Application::$app->router->renderView('/admin/about_us/add.php');
    }
}
