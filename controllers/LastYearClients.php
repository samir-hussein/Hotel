<?php
namespace controllers;

use core\Application;
use models\LastYearClientsModel;

class LastYearClients
{
    public function clients()
    {
        $clients = new LastYearClientsModel();
        $clients->allClients();

        Application::$app->router->renderView('/admin/last_year_clients.php');
    }
}
