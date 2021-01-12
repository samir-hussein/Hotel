<?php
namespace controllers;

use core\Application;
use models\HomeComponentsModel;

class BookNow
{

    public function bookNow()
    {

        $roomsType = new HomeComponentsModel();
        $roomsType->rooms_types();
        Application::$app->router->renderView('booknow.php');
    }

    public function bookNowAdmin()
    {
        $roomsType = new HomeComponentsModel();
        $roomsType->rooms_types();
        Application::$app->router->renderView('/admin/reservation.php');
    }
}
