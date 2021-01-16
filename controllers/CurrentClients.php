<?php
namespace controllers;

use core\Application;
use models\CurrentClientsModel;

class CurrentClients
{

    public function clients()
    {
        $clients = new CurrentClientsModel();
        $clients->cancel();
        $clients->renew();
        $clients->checkOut();
        $clients->allClients();

        Application::$app->router->renderView('/admin/current_clients.php');
    }
}
