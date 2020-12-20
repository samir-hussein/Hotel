<?php
namespace models\about_us;

use core\Application;
use core\DataBase;
use core\Validation;

class AllAboutUsModel
{

    public function allData()
    {
        $sql = "SELECT * FROM about_us";
        if ($response = DataBase::$db->prepare($sql)) {
            Application::$app->router->loadData['allData'] = $response;
        }
    }

    public function checkDelete()
    {
        if (isset($_POST['delete']) && isset($_POST['id'])) {
            $id = Validation::validateInput($_POST['id']);
            $value = [
                'id' => $id,
            ];
            $sql = "SELECT * FROM about_us WHERE id=:id";
            if ($result = DataBase::$db->prepare($sql, $value)) {
                foreach ($result as $row) {
                    unlink("assets/videos/" . $row['vedio']);
                }
                $sql = "DELETE FROM about_us WHERE id=:id";

                if (DataBase::$db->prepare($sql, $value)) {
                    Application::$app->router->loadData['success'] = 'deleted successfully';
                }
            }
        }
    }
}
