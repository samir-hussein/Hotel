<?php
namespace controllers\all_rooms;

use core\Application;
use models\all_rooms\AllRoomsModel;

class AllRooms
{

    public function all()
    {
        $all = new AllRoomsModel();
        $all->checkDelete();
        $all->allData();
        Application::$app->router->renderView('/admin/all_rooms/all.php');
    }
}
