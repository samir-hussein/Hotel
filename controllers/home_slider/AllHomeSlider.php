<?php
namespace controllers\home_slider;

use core\Application;
use models\home_slider\AllHomeSliderModel;

class AllHomeSlider
{
    public function all()
    {

        $all = new AllHomeSliderModel();

        $all->checkDelete();
        $all->allData();
        Application::$app->router->renderView('/admin/Home_Slider/all.php');
    }
}
