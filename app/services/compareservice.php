<?php

namespace Services;
use Repositories\CompareRepository;
use Models\Card;


class CompareService
{
    private $compareRepository;

    public function __construct()
    {
        $this->compareRepository = new CompareRepository();
    }

    public function getAllPreCons() : array
    {
        return $this->compareRepository->getAllPreCons();
    }
    public function getPreConCards($id) : array
    {
        return $this->compareRepository->getPreConCards($id);
    }
    public function getPreConById($id) : array
    {
        return $this->compareRepository->getPreConById($id);
    }
    public function getCorrespondingCards($deck, $preConCards) : ?array
    {
        //compare deck with precon
        $userDeckCards = [];
        foreach ($deck as $card) {
            foreach ($preConCards as $preConCard) {
                if ($card->getName() == $preConCard['card_name']) {
                    $userDeckCards[] = $card;
                }
            }
        }
        return $userDeckCards;
    }
    public function getCorrespondingTotal($deck){
        $total = 0;
        foreach ($deck as $card) {
            $total += $card->getPrice() * $card->getAmount();
        }
        return $total;
    }
}