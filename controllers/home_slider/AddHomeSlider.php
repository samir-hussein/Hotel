<?php

namespace controllers\home_slider;

use core\Application;
use models\home_slider\AddHomeSliderModel;

class AddHomeSlider
{

    public function add()
    {

        $add = new AddHomeSliderModel();

        if ($add->checkSubmit()) {
            $add->validate();
        }

        Application::$app->router->renderView('/admin/Home_Slider/add.php');

    }
}
