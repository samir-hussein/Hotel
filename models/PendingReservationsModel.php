<?php
namespace models;

use core\Application;
use core\DataBase;
use core\Validation;

class PendingReservationsModel
{

    public function pending_reservations()
    {
        $sql = "SELECT * FROM clients WHERE paid='no'";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['clients'] = $response;
        }
    }

    public function confirm_reservation()
    {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = Validation::validateInput($_POST['id']);
            $sql = "UPDATE clients SET paid='yes',expire_day=null WHERE id=:id";
            $value = ['id' => $id];
            if (DataBase::$db->prepare($sql, $value)) {
                Application::$app->router->loadData['success'] = 'reservation confirmed';
            }
        }
    }
}
