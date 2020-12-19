<?php
namespace controllers\hotel_images;

use core\Application;
use models\hotel_images\AllHotelImagesModel;

class AllHotelImages
{

    public function all()
    {

        $all = new AllHotelImagesModel();
        $all->checkDelete();
        $all->allData();
        Application::$app->router->renderView('/admin/hotel_images/all.php');
    }
}
