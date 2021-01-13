<?php
namespace controllers;

use core\Application;
use models\CMSHomeModel;
use models\HomeComponentsModel;

class HomeComponents
{

    public function component()
    {
        $component = new HomeComponentsModel();
        $component->all_components();
        $convert_rooms_status = new CMSHomeModel();
        $convert_rooms_status->check_expire();
        $convert_rooms_status->convert_rooms_status();
        Application::$app->router->renderView('home.php');
    }
}
