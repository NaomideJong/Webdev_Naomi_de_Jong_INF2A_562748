<?php

namespace Controllers;

class LogoutController
{
    public function index() : void
    {
        session_destroy();
        header('location: /');
    }

}