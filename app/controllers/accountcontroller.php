<?php

namespace Controllers;
use Services\AccountService;

class AccountController
{
    private $accountService;

    public function __construct()
    {
        $this->accountService = new AccountService();
    }
    public function index() : void
    {
        if(isset($_SESSION['user_id'])){
            $decks = $this->accountService->getDecks();
            require __DIR__ . '/../views/account/index.php';
        }
        else{
            header('Location: /login');
        }
    }
}