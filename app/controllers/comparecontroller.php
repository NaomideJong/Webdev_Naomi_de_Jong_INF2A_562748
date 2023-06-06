<?php

namespace Controllers;
use Services\CompareService;
use Services\AccountService;
use Services\DeckService;
require __DIR__ . '/../services/CompareService.php';
require __DIR__ . '/../services/AccountService.php';
require __DIR__ . '/../services/DeckService.php';

class CompareController
{
    private $compareService;
    private $accountService;
    private $deckService;

    public function __construct()
    {
        $this->compareService = new CompareService();
        $this->accountService = new AccountService();
        $this->deckService = new DeckService();
    }
    public function index() : void
    {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $preConCards = $this->compareService->getPreConCards($id);

            if(!$preConCards) {
                header('Location: /compare');
                return;
            }
            $preCon = $this->compareService->getPreConById($id);
            $userDecks = $this->accountService->getDecks();

            if (isset($_POST['compare'])) {
                $deckId = $_POST['deck_id'];
                $deck = $this->deckService->getDeck($deckId);
                $userDeckCards = $this->compareService->getCorrespondingCards($deck, $preConCards);
                $userDeckTotal = $this->compareService->getCorrespondingTotal($userDeckCards);
            }

            require __DIR__ . '/../views/compare/preCon.php';
            return;
        }

        $preCons = $this->compareService->getAllPreCons();
        require __DIR__ . '/../views/compare/index.php';
    }

}