<?php

namespace Controllers;
use Services\DeckService;

class DeckController
{
    private $deckService;

    public function __construct()
    {
        $this->deckService = new DeckService();
    }
    public function index() : void
    {
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
        }
        else{
            if(isset($_GET['id']))
            {
                $deckId = $_GET['id'];
                $cards = $this->deckService->getDeck($deckId);
                $totalPrice = $this->deckService->calculatePrice($cards);
                require __DIR__ . '/../views/account/deck.php';
            }
            else{
                require __DIR__ . '/../views/home/index.php';
            }
            if(isset($_POST['addCardBtn'])){
                $cardName = $_POST['cardName'];
                $amount = $_POST['amount'];
                $deckId = $_GET['id'];
                $this->deckService->addCard($cardName, $amount, $deckId);
            }
        }
    }
}