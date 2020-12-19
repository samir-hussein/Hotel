<?php
namespace controllers\hotel_images;

use core\Application;
use models\hotel_images\AddHotelImagesModel;

class AddHotelImages
{

    public function add()
    {

        $add = new AddHotelImagesModel();

        if ($add->checkSubmit()) {
            $add->validate();
        }
        Application::$app->router->renderView('/admin/hotel_images/add.php');
    }
}
