<?php
namespace controllers\room_types;

use core\Application;
use models\room_types\AddRoomTypeModel;

class AddRoomType
{

    public function add()
    {
        $add = new AddRoomTypeModel();
        if ($add->checkSubmit()) {
            $add->validate();
        }

        $add->checkEdit();
        if ($add->edit()) {
            Application::$app->response->redirect('/admin/all_room_types?success');
        }
        Application::$app->router->renderView('/admin/room_types/add.php');
    }
}
