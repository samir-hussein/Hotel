<?php
namespace controllers\room_types;

use core\Application;
use models\room_types\AllRoomTypesModel;

class AllRoomTypes
{

    public function all()
    {
        $all = new AllRoomTypesModel();
        $all->checkDelete();
        $all->allData();
        Application::$app->router->renderView('/admin/room_types/all.php');
    }
}
