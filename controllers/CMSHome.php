<?php

namespace controllers;

use core\Application;
use models\CMSHomeModel;

class CMSHome
{
    public function components()
    {
        $components = new CMSHomeModel();
        $components->visits();
        $components->checkIN();
        $components->checkOut();
        $components->emptyRooms();
        Application::$app->router->renderView('/admin/index.php');
    }
}
