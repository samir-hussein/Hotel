<?php
namespace models;

use core\Application;
use core\DataBase;

class HomeComponentsModel
{

    public function visits()
    {
        //total visits functionality
        $sql = "SELECT total_visits From visits";
        if ($response = DataBase::$db->prepare($sql)) {
            $totalVisits = $response[0]['total_visits'];
            $totalVisits++;
            $sql = "UPDATE visits SET total_visits=$totalVisits";
            DataBase::$db->prepare($sql);
        }

        //visitors functionality
        $visitor_id = $_SERVER['REMOTE_ADDR'];
        $sql = "SELECT * FROM visitors WHERE visitor_id='$visitor_id'";
        if (!DataBase::$db->prepare($sql)) {
            $sql = "INSERT INTO visitors (visitor_id) VALUES ('$visitor_id')";
            DataBase::$db->prepare($sql);
        }

        //daily visits functionality
        $sql = "SELECT today FROM visits";
        if ($response = DataBase::$db->prepare($sql)) {
            $today = $response[0]['today'];
            $day = date('d');
            if ($day != $today) {
                $sql = "UPDATE visits SET today=$day, daily_visits=0";
                DataBase::$db->prepare($sql);
            }
            $sql = "SELECT daily_visits FROM visits";
            if ($response = DataBase::$db->prepare($sql)) {
                $daily_visits = $response[0]['daily_visits'];
                $daily_visits++;
                $sql = "UPDATE visits SET daily_visits=$daily_visits";
                DataBase::$db->prepare($sql);
            }
        }

    }

    public function home_slider()
    {
        $sql = "SELECT * FROM home_slider";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['home_slider'] = $response;
        }
    }

    public function about_us()
    {
        $sql = "SELECT * FROM about_us";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['about_us'] = $response;
        }
    }

    public function hotel_images()
    {
        $sql = "SELECT * FROM hotel_images";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['hotel_images'] = $response;
        }
    }

    public function rooms_types()
    {
        $sql = "SELECT * FROM rooms_types";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['rooms_types'] = $response;
        }
    }

    public function food_departments()
    {
        $sql = "SELECT * FROM food_departments";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['food_departments'] = $response;
        }
    }

    public function all_foods()
    {
        $sql = "SELECT * FROM all_foods";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['all_foods'] = $response;
        }
    }

    public function all_components()
    {
        $this->visits();
        $this->home_slider();
        $this->about_us();
        $this->hotel_images();
        $this->rooms_types();
        $this->food_departments();
        $this->all_foods();
    }
}
