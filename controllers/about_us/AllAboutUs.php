<?php
namespace controllers\about_us;

use core\Application;
use models\about_us\AllAboutUsModel;

class AllAboutUs
{

    public function all()
    {

        $all = new AllAboutUsModel();
        $all->checkDelete();
        $all->allData();

        Application::$app->router->renderView('/admin/about_us/all.php');
    }
}
