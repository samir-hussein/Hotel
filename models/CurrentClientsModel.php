<?php
namespace models;

use core\Application;
use core\DataBase;
use core\Validation;

class CurrentClientsModel
{

    public function allClients()
    {
        $today = date('Y-m-d');
        $sql = "SELECT * FROM clients WHERE check_out>= '$today'";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['clients'] = $response;
        }
    }

    public function checkOut()
    {
        if (isset($_POST['check_out'])) {
            if (isset($_POST['out']) && isset($_POST['in']) && isset($_POST['id']) && isset($_POST['rooms']) && !empty($_POST['out']) && !empty($_POST['in']) && !empty($_POST['rooms']) && !empty($_POST['id'])) {
                $check_in = Validation::validateInput($_POST['in']);
                $today = date('Y-m-d');
                if ($check_in >= $today) {
                    Application::$app->router->loadData['success'] = 'you can not check out, use cancel reservation';
                } else {
                    $check_out = Validation::validateInput($_POST['out']);
                    $id = Validation::validateInput($_POST['id']);
                    $total_nights = date_diff(date_create($check_out), date_create($today));
                    $total_nights = $total_nights->format("%a");
                    $all_rooms = Validation::validateInput($_POST['rooms']);
                    $all_rooms = explode('-', $all_rooms);

                    $remaining = 0;
                    foreach ($all_rooms as $room) {
                        $sql = "SELECT * FROM all_rooms WHERE name=:room";
                        $value = ['room' => $room];
                        if ($response = DataBase::$db->prepare($sql, $value)) {
                            foreach ($response as $row) {
                                $type = $row['type'];
                                $sql = "SELECT * FROM rooms_types WHERE name='$type'";
                                if ($result = DataBase::$db->prepare($sql)) {
                                    foreach ($result as $cost) {
                                        $cost = $cost['cost'];
                                        $remaining += $cost * $total_nights;

                                        $sql = "UPDATE all_rooms SET check_out='$today' WHERE name=:room";
                                        DataBase::$db->prepare($sql, $value);
                                    }
                                }
                            }
                        }
                    }

                    $sql = "SELECT * FROM clients WHERE id=:id";
                    $value = ['id' => $id];

                    if ($response = DataBase::$db->prepare($sql, $value)) {
                        foreach ($response as $row) {
                            $total_cost = $row['total_cost'];
                            $new_cost = $total_cost - $remaining;
                        }
                    }

                    $sql = "UPDATE clients SET check_out='$today',total_cost=$new_cost WHERE id=:id";
                    if (DataBase::$db->prepare($sql, $value)) {
                        Application::$app->router->loadData['success'] = 'check out was successfully, your remaining cost is $' . $remaining;
                    }
                }
            }
        }
    }

    public function renew()
    {
        if (isset($_POST['renew'])) {
            if (isset($_POST['out']) && isset($_POST['id']) && isset($_POST['rooms']) && !empty($_POST['out']) && !empty($_POST['rooms']) && !empty($_POST['id']) && !empty($_POST['in']) && isset($_POST['in'])) {
                $new_check_out = Validation::validateInput($_POST['out']);
                $check_in = Validation::validateInput($_POST['in']);
                $id = Validation::validateInput($_POST['id']);

                $all_rooms = Validation::validateInput($_POST['rooms']);
                $all_rooms = explode('-', $all_rooms);

                $sql = "SELECT * FROM clients WHERE id=:id";
                $value = ['id' => $id];
                if ($response = DataBase::$db->prepare($sql, $value)) {
                    foreach ($response as $row) {
                        $check_out = $row['check_out'];
                        $total_nights = date_diff(date_create($new_check_out), date_create($check_out));
                        $total_nights = $total_nights->format("%a");
                    }

                    $plus_cost = 0;
                    foreach ($all_rooms as $room) {
                        $sql = "SELECT * FROM all_rooms WHERE name=:room";
                        $value = ['room' => $room];
                        if ($response = DataBase::$db->prepare($sql, $value)) {
                            foreach ($response as $row) {
                                $type = $row['type'];
                                $sql = "SELECT * FROM rooms_types WHERE name='$type'";
                                if ($result = DataBase::$db->prepare($sql)) {
                                    foreach ($result as $cost) {
                                        $cost = $cost['cost'];
                                        $plus_cost += $cost * $total_nights;

                                        $sql = "UPDATE all_rooms SET check_out='$new_check_out',empty='no',check_in='$check_in' WHERE name=:room";
                                        DataBase::$db->prepare($sql, $value);
                                    }
                                }
                            }
                        }
                    }

                    $sql = "SELECT * FROM clients WHERE id=:id";
                    $value = ['id' => $id];

                    if ($response = DataBase::$db->prepare($sql, $value)) {
                        foreach ($response as $row) {
                            $total_cost = $row['total_cost'];
                            $new_cost = $total_cost + $plus_cost;
                        }
                    }

                    $sql = "UPDATE clients SET check_out='$new_check_out',total_cost=$new_cost WHERE id=:id";
                    if (DataBase::$db->prepare($sql, $value)) {
                        Application::$app->router->loadData['success'] = 'renewal was successfully, your plus cost is $' . $plus_cost;
                    }
                }

            }
        }
    }

    public function cancel()
    {
        if (isset($_POST['cancel_reservation'])) {
            if (isset($_POST['id']) && isset($_POST['rooms']) && !empty($_POST['rooms']) && !empty($_POST['id'])) {

                $id = Validation::validateInput($_POST['id']);
                $all_rooms = Validation::validateInput($_POST['rooms']);
                $all_rooms = explode('-', $all_rooms);

                foreach ($all_rooms as $room) {
                    $sql = "UPDATE all_rooms SET empty='yes',check_in=null,check_out=null WHERE name=:room";
                    $value = ['room' => $room];
                    if (DataBase::$db->prepare($sql, $value)) {

                        $value = ['id' => $id];
                        $sql = "SELECT * FROM clients WHERE id=:id";
                        if ($response = DataBase::$db->prepare($sql, $value)) {
                            foreach ($response as $row) {
                                $cost = $row['total_cost'];
                            }
                        }
                        $sql = "DELETE FROM clients WHERE id=:id";
                        if (DataBase::$db->prepare($sql, $value)) {
                            Application::$app->router->loadData['success'] = 'the reservation was canceled, you can back $' . $cost;
                        }

                    }
                }
            }
        }
    }
}
