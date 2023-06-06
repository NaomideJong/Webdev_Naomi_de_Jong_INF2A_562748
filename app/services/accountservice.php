<?php

namespace Services;
require __DIR__ . '/../repositories/accountrepository.php';
use Repositories\AccountRepository;

class AccountService
{
    private $accountRepository;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();
    }

    public function getDecks() : array
    {
        return $this->accountRepository->getDecks();
    }
}