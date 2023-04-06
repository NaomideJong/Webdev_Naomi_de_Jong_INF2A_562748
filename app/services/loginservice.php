<?php

namespace Services;
use Repositories\LoginRepository;

class LoginService
{
    private $loginRepository;

    public function __construct()
    {
        $this->loginRepository = new LoginRepository();
    }

    public function login($username, $password)
    {
        $user = $this->loginRepository->login($username, $password);
        if ($user != null) {
            $_SESSION['user'] = $user['username'];
            header('location: /account');
        } else {
            $_SESSION['errors'] = 'Invalid username or password';
            header('location: /login');
        }
    }
}