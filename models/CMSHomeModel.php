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
}
