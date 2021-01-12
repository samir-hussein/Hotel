<?php
namespace models;

use core\DataBase;
use core\Validation;

class CheckAvailabilityModel
{

    public function check()
    {
        if (isset($_POST['checkIn']) && isset($_POST['checkOut']) && isset($_POST['arr']) && isset($_POST['adults']) && isset($_POST['children']) && !empty($_POST['checkIn']) && !empty($_POST['checkOut']) && !empty($_POST['arr']) && !empty($_POST['adults'])) {

            $checkIn = Validation::validateInput($_POST['checkIn']);
            $checkOut = Validation::validateInput($_POST['checkOut']);
            $adults = Validation::validateInput($_POST['adults']);
            $children = Validation::validateInput($_POST['children']);

            if ($checkOut <= $checkIn) {
                return "Check Your Check Out Date";
            }

            $arr = $_POST['arr'];
            $total_adults = 0;
            $total_children = 0;
            for ($i = 0; $i < count($arr); $i++) {
                $roomType = $arr[$i][0];
                $sql = "SELECT * FROM rooms_types WHERE name=:roomType";
                $value = ['roomType' => $roomType];

                if ($response = DataBase::$db->prepare($sql, $value)) {
                    $total_children += $response[0]['children'];
                    $total_adults += $response[0]['adults'];

                    $sql = "SELECT count(*) FROM all_rooms WHERE (type=:roomType) AND (empty='yes' OR check_out < :checkIn)";
                    $values = [
                        'roomType' => $roomType,
                        'checkIn' => $checkIn,
                    ];
                    if ($response = DataBase::$db->prepare($sql, $values)) {
                        $availableRooms = $response[0]['count(*)'];
                        if ($availableRooms < $arr[$i][1]) {
                            return 'No Rooms Available Right Now';
                        }
                    }
                } else {
                    return "No Room With This Name Check Your Room Type";
                }
            }

            if (count($arr) == 1) {
                $total_adults = $total_adults * $arr[0][1];
                $total_children = $total_children * $arr[0][1];
            }
            if ($total_adults < $adults || $total_children < $children) {
                return "Too much adults or children";
            } else {
                return 'true';
            }

        } else {
            return 'Empty Field';
        }
    }

    public function bookNow()
    {
        if ($this->check() != 'true') {
            return $this->check();
        } else {
            if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['id']) && !empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['id'])) {

                $name = Validation::validateInput($_POST['name']);
                $notes = Validation::validateInput($_POST['notes']);
                $phone = Validation::phoneNumber($_POST['phone']);
                $id = Validation::phoneNumber($_POST['id']);
                $checkIn = Validation::validateInput($_POST['checkIn']);
                $checkOut = Validation::validateInput($_POST['checkOut']);
                $adults = Validation::validateInput($_POST['adults']);
                $children = Validation::validateInput($_POST['children']);
                $totalRooms = Validation::validateInput($_POST['numberOfRooms']);

                $arr = $_POST['arr'];
                $roomsNames = '';
                $total_nights = date_diff(date_create($checkIn), date_create($checkOut));
                $total_nights = $total_nights->format("%a");
                $total_cost = 0;
                $count2 = $totalRooms;

                for ($i = 0; $i < count($arr); $i++) {
                    $roomType = $arr[$i][0];
                    $numberOfRooms = $arr[$i][1];

                    $sql = "SELECT * FROM all_rooms WHERE (type=:roomType) AND (empty='yes' OR check_out < :checkIn)";
                    $values = [
                        'roomType' => $roomType,
                        'checkIn' => $checkIn,
                    ];

                    if ($response = DataBase::$db->prepare($sql, $values)) {
                        $count = $numberOfRooms;
                        foreach ($response as $row) {
                            if ($count > 0) {
                                $roomsNames .= $row['name'];
                                $count--;
                                $count2--;
                                if ($count2 > 0) {
                                    $roomsNames .= '-';
                                }
                            }
                        }
                    }

                    $sql = "SELECT * FROM rooms_types WHERE name=:roomType";
                    $value = ['roomType' => $roomType];
                    if ($response = DataBase::$db->prepare($sql, $value)) {
                        $costPerNight = $response[0]['cost'];
                        $total_cost += $total_nights * $costPerNight * $numberOfRooms;
                    }
                }

                $sql = "INSERT INTO clients (name,phone,national_id,check_in,check_out,adults,children,room_type,number_of_rooms,rooms_names,total_cost,notes,paid) VALUES (:name,:phone,:national_id,:check_in,:check_out,:adults,:children,:room_type,:number_of_rooms,:rooms_names,:total_cost,:notes,:paid)";

                $all_rooms_types = '';
                $length = count($arr);
                for ($i = 0; $i < count($arr); $i++) {
                    $all_rooms_types .= $arr[$i][0];
                    $length--;
                    if ($length > 0) {
                        $all_rooms_types .= ',';
                    }
                }

                $paid = 'no';
                if (isset($_POST['paid']) && !empty($_POST['paid'])) {
                    $paid = Validation::validateInput($_POST['paid']);
                }

                $values = [
                    'name' => $name,
                    'phone' => $phone,
                    'national_id' => $id,
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'adults' => $adults,
                    'children' => (!empty($children)) ? $children : 0,
                    'room_type' => $all_rooms_types,
                    'number_of_rooms' => $totalRooms,
                    'rooms_names' => $roomsNames,
                    'total_cost' => $total_cost,
                    'notes' => $notes,
                    'paid' => $paid,
                ];

                if (DataBase::$db->prepare($sql, $values)) {
                    $flag = true;
                    $all_rooms = explode('-', $roomsNames);

                    foreach ($all_rooms as $roomName) {
                        $sql = "UPDATE all_rooms SET check_in=:check_in, check_out=:check_out, empty='no' WHERE name=:roomName";
                        $values = [
                            'check_in' => $checkIn,
                            'check_out' => $checkOut,
                            'roomName' => $roomName,
                        ];
                        if (DataBase::$db->prepare($sql, $values) !== true) {
                            $flag = false;
                        }
                    }
                    if ($flag) {
                        return $total_cost . '/finished';
                    }
                }

            } else {
                return "Empty Field";
            }
        }
    }
}
