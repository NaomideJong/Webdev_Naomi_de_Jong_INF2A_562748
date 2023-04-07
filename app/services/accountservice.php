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

    public function getDecks() : array
    {
        return $this->accountRepository->getDecks();
    }
}