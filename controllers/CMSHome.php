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
        $components->check_expire();
        $components->checkIN();
        $components->checkOut();
        $components->convert_rooms_status();
        $components->emptyRooms();

        Application::$app->router->renderView('/admin/index.php');
    }
}
