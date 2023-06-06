<?php
namespace Controllers;
use Services\RegisterService;
require dirname(__DIR__) . '/services/registerService.php';

class RegisterController
{
    private $registerService;

    public function __construct()
    {
        $this->registerService = new RegisterService();
    }
    public function index(): void
    {
        if (isset($_SESSION['user'])) {
            header('location: /home');
        }

        if(isset($_POST["submit"])){
            if($_POST["password"] == $_POST["password-confirm"]){
                $this->register();
            }else{
                $_SESSION['errors'] = 'Passwords do not match';
                header('location: /register');
            }
        }
        else{
            require dirname(__DIR__) . '/views/login/register.php';
        }
    }

    public function register() : void
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        $this->registerService->register($username, $password);
    }
}