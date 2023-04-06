<?php
namespace Controllers;
use Services\LoginService;
class LoginController
{
    private $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }
    public function index() : void
    {
        if (isset($_SESSION['user'])) {
            header('location: /home/account');
        }

        if(isset($_POST["submit"])){
            $this->login();
        }
        else{
            require dirname(__DIR__) . '/views/login/login.php';
        }
    }

    public function login() : void
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->loginService->login($username, $password);
    }
}