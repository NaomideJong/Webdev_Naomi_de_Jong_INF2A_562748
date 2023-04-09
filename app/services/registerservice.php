<?php

namespace Services;
use Repositories\RegisterRepository;

class RegisterService
{
    private $registerRepository;

    public function __construct()
    {
        $this->registerRepository = new RegisterRepository();
    }
    public function register($username, $password) : void
    {
        if($this->checkUniqueUsername($username)){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->registerRepository->register($username, $password);
            header('location: /login');
        }
    }

    public function checkUniqueUsername($username) : bool
    {
        $user = $this->registerRepository->checkUniqueUsername($username);
        if (!$user) {
            $_SESSION['errors'] = 'Username already exists';
            header('location: /register');
            return false;
        }
        return true;
    }

}