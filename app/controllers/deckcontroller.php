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
        $deckId = $_GET['id'];
        $decks = $this->deckService->getDeck($deckId);
        require __DIR__ . '/../views/account/deck.php';
    }
}