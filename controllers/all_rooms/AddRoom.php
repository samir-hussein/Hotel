<?php
namespace controllers\all_rooms;

use core\Application;
use models\all_rooms\AddRoomModel;

class AddRoom
{

    public function add()
    {
        $add = new AddRoomModel();
        $add->allTypes();
        if ($add->checkSubmit()) {
            $add->validate();
        }

        $add->checkEdit();
        if ($add->edit()) {
            Application::$app->response->redirect('/admin/all_rooms?success');
        }
        Application::$app->router->renderView('/admin/all_rooms/add.php');
    }
}
