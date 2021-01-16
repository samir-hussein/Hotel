<?php
namespace models;

use core\Application;
use core\DataBase;

class LastYearClientsModel
{

    public function allClients()
    {
        $today = date('Y-m-d');
        $sql = "SELECT * FROM clients WHERE check_out < '$today'";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData = $response;
        }
    }
}
