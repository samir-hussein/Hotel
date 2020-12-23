<?php
namespace controllers\all_foods;

use core\Application;
use models\all_foods\AllFoodsModel;

class AllFoods
{

    public function all()
    {
        $all = new AllFoodsModel();
        $all->checkDelete();
        $all->allData();

        Application::$app->router->renderView('/admin/all_foods/all.php');
    }
}
