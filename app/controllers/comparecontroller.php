<?php

namespace Controllers;
use Repositories\CompareRepository;

class CompareController
{
    public function index() : void
    {

        $compareRepository = new CompareRepository();
        $compareRepository->jsonToCards();




        require __DIR__ . '/../views/compare/index.php';
    }

}