<?php

/**
 * @author Samir Hussein <samirhussein274@gmail.com>
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'core/autoload.php';

use controllers\about_us\AddAboutUs;
use controllers\about_us\AllAboutUs;
use controllers\all_foods\AddFood;
use controllers\all_foods\AllFoods;
use controllers\all_rooms\AddRoom;
use controllers\all_rooms\AllRooms;
use controllers\food_departments\AddFoodDepartment;
use controllers\food_departments\AllFoodDepartments;
use controllers\HomeComponents;
use controllers\home_slider\AddHomeSlider;
use controllers\home_slider\AllHomeSlider;
use controllers\hotel_images\AddHotelImages;
use controllers\hotel_images\AllHotelImages;
use controllers\Login;
use controllers\Logout;
use controllers\room_types\AddRoomType;
use controllers\room_types\AllRoomTypes;
use controllers\users\AddUser;
use controllers\users\AllUsers;
use core\Application;

// Database cofigration
$config = [
    'serverName' => 'localhost',
    'userName' => 'root',
    'password' => '',
    'dbName' => 'hotel',
];

$app = new Application($config);

$app->router->route('/', [HomeComponents::class, 'component']);
$app->router->route('/book-now', 'booknow.php');

// Admin Panel
$app->router->route('/admin', [Login::class, 'login']);
$app->router->route('/logout', [Logout::class, 'logout']);
$app->router->route('/admin/home', '/admin/index.php');
$app->router->route('/admin/add-user', [AddUser::class, 'add']);
$app->router->route('/admin/all-user', [AllUsers::class, 'allUsers']);
$app->router->route('/admin/add_home_slider', [AddHomeSlider::class, 'add']);
$app->router->route('/admin/all_home_slider', [AllHomeSlider::class, 'all']);
$app->router->route('/admin/add_hotel_images', [AddHotelImages::class, 'add']);
$app->router->route('/admin/all_hotel_images', [AllHotelImages::class, 'all']);
$app->router->route('/admin/add_about_us', [AddAboutUs::class, 'add']);
$app->router->route('/admin/all_about_us', [AllAboutUs::class, 'all']);
$app->router->route('/admin/add_food_department', [AddFoodDepartment::class, 'add']);
$app->router->route('/admin/delete_food_department', [AllFoodDepartments::class, 'all']);
$app->router->route('/admin/add_food', [AddFood::class, 'add']);
$app->router->route('/admin/all_foods', [AllFoods::class, 'all']);
$app->router->route('/admin/add_room_type', [AddRoomType::class, 'add']);
$app->router->route('/admin/all_room_types', [AllRoomTypes::class, 'all']);
$app->router->route('/admin/add_room', [AddRoom::class, 'add']);
$app->router->route('/admin/all_rooms', [AllRooms::class, 'all']);

$app->run();
