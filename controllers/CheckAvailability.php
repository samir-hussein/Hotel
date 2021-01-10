<?php
namespace controllers;

use models\CheckAvailabilityModel;

class CheckAvailability
{
    public $response;

    public function __construct()
    {
        $this->response = new CheckAvailabilityModel();
    }

    public function check()
    {
        return $this->response->check();
    }

    public function bookNow()
    {
        return $this->response->bookNow();
    }
}
