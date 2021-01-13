<?php
namespace controllers;

use core\Application;
use models\PendingReservationsModel;

class PendingReservations
{

    public function controller()
    {
        $clients = new PendingReservationsModel();
        $clients->confirm_reservation();
        $clients->pending_reservations();
        Application::$app->router->renderView('/admin/pending_reservations.php');
    }
}
