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

        require __DIR__ . '/../views/account/index.php';
    }
}