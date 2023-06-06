<?php

namespace Controllers;
use Services\DeckService;
require __DIR__ . '/../services/deckservice.php';

class DeckController
{
    private $deckService;
    public $deckId;

    public function __construct()
    {
        $this->deckService = new DeckService();
        if(isset($_GET['id']))
        {
            $this->deckId = $_GET['id'];
        }
    }
    public function index() : void
    {
        if(!isset($_SESSION['user_id'])){
            header('Location: /login');
        }
        else{
            // check if the request method is POST for add card
            if (isset($_POST['addCard'])) {
            $cardName = $_POST['cardName'] ?? null;
            $cardAmount = $_POST['cardAmount'] ?? 1;
            // call the addCard function with the given parameters
            $this->addCard($cardName, $cardAmount);
            }
            elseif(isset($_POST['deleteDeck'])){
                $this->deckService->deleteDeck($this->deckId);
                header('Location: /account');
            }
            elseif(isset($this->deckId))
            {
                $deckName = $this->deckService->getDeckName($this->deckId);
                $cards = $this->deckService->getDeck($this->deckId);
                $totalPrice = $this->deckService->calculatePrice($cards);
                require __DIR__ . '/../views/account/deck.php';
            }
            else{
                require __DIR__ . '/../views/home/index.php';
            }
        }
    }
    public function addCard($cardName, $cardAmount) : void
    {
        $this->deckService->addCard($this->deckId, $cardName, $cardAmount);
    }

    public function removeCards()
    {
        // check if post for delete cards
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestBody = file_get_contents('php://input');
            $requestData = json_decode($requestBody, true);

            $cardsToDelete = $requestData['cardNames'];
            $deckId = $requestData['deckId'];
            $this->console_log($deckId);
            header('Content-Type: application/json; charset=utf-8');
            try {
                foreach ($cardsToDelete as $cardName) {
                    $this->deckService->deleteCard($deckId, $cardName);
                }
                http_response_code(200);
                echo json_encode('Cards removed from cart');
            } catch (\Exception $e) {
                // respond as api
                http_response_code(400);
                echo json_encode($e->getMessage());
                exit;
            }
        }
    }

    public function updateAmount(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestBody = file_get_contents('php://input');
            $requestData = json_decode($requestBody, true);
            $cardName = $requestData['cardName'];
            $deckId = $requestData['deckId'];
            $amount = $requestData['newAmount'];
            header('Content-Type: application/json; charset=utf-8');
            try {
                $this->deckService->updateAmount($deckId, $cardName, $amount);
                http_response_code(200);
                echo json_encode('Amount updated');
            } catch (\Exception $e) {
                // respond as api
                http_response_code(400);
                echo json_encode($e->getMessage());
                exit;
            }
        }
    }

    function console_log($output, $with_script_tags = true)
    {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
            ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

}