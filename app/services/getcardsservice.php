<?php

namespace Services;
use Repositories\GetCardsRepository;

class GetCardsService
{
    private $getCardsRepository;

    public function __construct()
    {
        $this->getCardsRepository = new GetCardsRepository();
    }

    public function getCards($deck_id) : array
    {
        return $this->getCardsRepository->getCards($deck_id);
    }


}