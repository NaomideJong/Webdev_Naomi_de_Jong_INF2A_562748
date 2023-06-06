<?php

namespace Services;
require dirname(__DIR__) . '/repositories/loginrepository.php';
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
            $_SESSION['user_id'] = $user['id'];
            header('location: /account');
        } else {
            $_SESSION['errors'] = 'Invalid username or password';
            header('location: /login');
        }
    }
}