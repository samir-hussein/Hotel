<?php

namespace models;

use core\Application;
use core\DataBase;

class CMSHomeModel
{
    public function visits()
    {
        $sql = "SELECT today FROM visits";
        if ($response = DataBase::$db->prepare($sql)) {
            $today = $response[0]['today'];
            $day = date('d');
            if ($day != $today) {
                $sql = "UPDATE visits SET today=$day, daily_visits=0";
                DataBase::$db->prepare($sql);
            }
        }

        $sql = "SELECT total_visits,daily_visits FROM visits";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['total_visits'] = $response[0]['total_visits'];
            Application::$app->router->loadData['daily_visits'] = $response[0]['daily_visits'];
        }

        $sql = "SELECT count(*) FROM visitors";
        if ($response = DataBase::$db->countColumn($sql)) {
            Application::$app->router->loadData['visitors'] = $response;
        }
    }

    public function checkIN()
    {
        $today = date('Y-m-d');
        $sql = "SELECT * FROM clients WHERE check_in='$today'";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['check_in'] = $response;
        }
    }

    public function checkOut()
    {
        $today = date('Y-m-d');
        $sql = "SELECT * FROM clients WHERE check_out='$today'";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['check_out'] = $response;
        }
    }

    public function emptyRooms()
    {
        $sql = "SELECT * FROM all_rooms WHERE empty='yes'";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['empty_rooms'] = $response;
        }
    }

    public function convert_rooms_status()
    {
        $today = date('Y-m-d');
        $sql = "UPDATE all_rooms SET empty='yes',check_in=null,check_out=null WHERE check_out<='$today'";
        DataBase::$db->prepare($sql);
    }

    public function check_expire()
    {
        $today = date('Y-m-d');
        $sql = "SELECT * FROM clients WHERE expire_day<='$today'";
        if ($response = DataBase::$db->prepare($sql)) {
            foreach ($response as $row) {
                $rooms_names = explode("-", $row['rooms_names']);
                foreach ($rooms_names as $room) {
                    $sql = "UPDATE all_rooms SET empty='yes',check_in=null,check_out=null WHERE name='$room'";
                    DataBase::$db->prepare($sql);
                }
            }
        }
        $sql = "DELETE FROM clients WHERE expire_day<='$today'";
        DataBase::$db->prepare($sql);
    }
}
