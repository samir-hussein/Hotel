<?php
namespace models;

use core\Application;
use core\DataBase;

class HomeComponentsModel
{

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
        $this->home_slider();
        $this->about_us();
        $this->hotel_images();
        $this->rooms_types();
        $this->food_departments();
        $this->all_foods();
    }
}
