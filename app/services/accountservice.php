<?php

namespace Services;
use Repositories\AccountRepository;

class AccountService
{
    private $accountRepository;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
    }

    public function index() : void
    {
        require __DIR__ . '/../views/account/index.php';
    }
}