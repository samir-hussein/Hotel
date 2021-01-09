<?php
namespace controllers;

use core\Application;
use models\HomeComponentsModel;

class HomeComponents
{

    public function component()
    {
        $component = new HomeComponentsModel();
        $component->all_components();
        Application::$app->router->renderView('home.php');
    }
}
