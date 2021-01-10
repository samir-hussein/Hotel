<?php
namespace models;

use core\DataBase;
use core\Validation;

class CheckAvailabilityModel
{

    public function check()
    {
        if (isset($_POST['checkIn']) && isset($_POST['checkOut']) && isset($_POST['roomType']) && isset($_POST['numberOfRooms']) && isset($_POST['adults']) && isset($_POST['children']) && !empty($_POST['checkIn']) && !empty($_POST['checkOut']) && !empty($_POST['roomType']) && !empty($_POST['numberOfRooms']) && !empty($_POST['adults'])) {

            $checkIn = Validation::validateInput($_POST['checkIn']);
            $checkOut = Validation::validateInput($_POST['checkOut']);
            $roomType = Validation::validateInput($_POST['roomType']);
            $numberOfRooms = Validation::validateInput($_POST['numberOfRooms']);
            $adults = Validation::validateInput($_POST['adults']);
            $children = Validation::validateInput($_POST['children']);

            if ($checkOut <= $checkIn) {
                return "Check Your Check Out Date";
            }

            $adultsOneRoom = ceil($adults / $numberOfRooms);
            $childrenOneRoom = (!empty($children)) ? ceil($children / $numberOfRooms) : '';

            $sql = "SELECT * FROM rooms_types WHERE name=:roomType";
            $value = ['roomType' => $roomType];

            if ($response = DataBase::$db->prepare($sql, $value)) {
                if ($adultsOneRoom <= $response[0]['adults'] && $childrenOneRoom <= $response[0]['children']) {
                    $sql = "SELECT count(*) FROM all_rooms WHERE (type=:roomType) AND (empty='yes' OR check_out < :checkIn)";
                    $values = [
                        'roomType' => $roomType,
                        'checkIn' => $checkIn,
                    ];
                    if ($response = DataBase::$db->prepare($sql, $values)) {
                        $availableRooms = $response[0]['count(*)'];

                        if ($availableRooms >= $numberOfRooms) {
                            return 'true';
                        } else {
                            return 'No Rooms Available Right Now';
                        }
                    }
                } else {
                    return "Too much adults or children";
                }
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
                $roomType = Validation::validateInput($_POST['roomType']);
                $numberOfRooms = Validation::validateInput($_POST['numberOfRooms']);
                $adults = Validation::validateInput($_POST['adults']);
                $children = Validation::validateInput($_POST['children']);

                $sql = "SELECT * FROM all_rooms WHERE (type=:roomType) AND (empty='yes' OR check_out < :checkIn)";
                $values = [
                    'roomType' => $roomType,
                    'checkIn' => $checkIn,
                ];
                if ($response = DataBase::$db->prepare($sql, $values)) {
                    $count = $numberOfRooms;
                    $roomsNames = '';
                    foreach ($response as $row) {
                        if ($count > 0) {
                            $roomsNames .= $row['name'];
                            $count--;
                            if ($count > 0) {
                                $roomsNames .= '-';
                            }
                        } else {
                            break;
                        }
                    }
                }

                $sql = "SELECT * FROM rooms_types WHERE name=:roomType";
                $value = ['roomType' => $roomType];
                if ($response = DataBase::$db->prepare($sql, $value)) {
                    $costPerNight = $response[0]['cost'];
                    $total_nights = date_diff(date_create($checkIn), date_create($checkOut));
                    $total_nights = $total_nights->format("%a");
                    $total_cost = $total_nights * $costPerNight * $numberOfRooms;
                    echo $total_cost;
                }

                $sql = "INSERT INTO clients (name,phone,national_id,check_in,check_out,adults,children,room_type,number_of_rooms,rooms_names,total_cost,notes) VALUES (:name,:phone,:national_id,:check_in,:check_out,:adults,:children,:room_type,:number_of_rooms,:rooms_names,:total_cost,:notes)";
                $values = [
                    'name' => $name,
                    'phone' => $phone,
                    'national_id' => $id,
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'adults' => $adults,
                    'children' => $children,
                    'room_type' => $roomType,
                    'number_of_rooms' => $numberOfRooms,
                    'rooms_names' => $roomsNames,
                    'total_cost' => $total_cost,
                    'notes' => $notes,
                ];

                if (DataBase::$db->prepare($sql, $values)) {

                    $all_rooms = explode('-', $roomsNames);

                    foreach ($all_rooms as $roomName) {
                        $sql = "UPDATE all_rooms SET check_in=:check_in, check_out=:check_out, empty='no' WHERE name=:roomName";
                        $values = [
                            'check_in' => $checkIn,
                            'check_out' => $checkOut,
                            'roomName' => $roomName,
                        ];
                        DataBase::$db->prepare($sql, $values);
                    }
                    return true;
                }

            } else {
                return "Empty Field";
            }
        }
    }
}
