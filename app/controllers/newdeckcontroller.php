<?php

namespace Controllers;
use Services\DeckService;

class NewDeckController
{
    private $deckService;

    public function __construct()
    {
        $this->deckService = new DeckService();
    }
    public function index() : void
    {
        if(isset($_POST["submit"])){
            $this->newDeck();
        }
        else{
            require __DIR__ . '/../views/account/newdeck.php';
        }
    }

    public function newDeck() : void
    {
        //put linebreak before every number
        $decklist = filter_input(INPUT_POST, 'decklist' );


        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $cardname = filter_input(INPUT_POST, 'cardname', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->deckService->newDeck($name, $decklist, $cardname);
    }
}