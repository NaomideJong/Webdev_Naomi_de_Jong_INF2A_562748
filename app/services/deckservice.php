<?php

namespace Services;
use Repositories\DeckRepository;
use Models\Card;
require __DIR__ . '/../repositories/deckrepository.php';
require_once __DIR__ . '/../models/card.php';

class DeckService
{
    private $deckRepository;

    public function __construct()
    {
        $this->deckRepository = new DeckRepository();
    }

    public function newDeck($name, $cards, $cardname) : void
    {
        //prepare the api call link
        $url = 'https://api.scryfall.com/cards/named?fuzzy=' . urlencode($cardname);

        //make the api call
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        //decode the json response
        $cardData = json_decode($response, true);
        //separate the image url from the rest of the data
        $thumbnail = $cardData['image_uris']['normal'];

        //insert the deck into the database
        $deckId = $this->deckRepository->newDeck($name, $cards, $thumbnail);

        //Redirect to the deck view page
        header('Location: /deck?id=' . $deckId);
    }
    public function getDeck($deckId) : ?array
    {
        $cards = $this->deckRepository->getDeck($deckId);
        $totalPrice = 0;
        if (!$cards) {
            return null;
        }
        else{
            foreach ($cards as $card) {
                $cardName = $card['card_name'];
                $amount = $card['amount'];
                $url = 'https://api.scryfall.com/cards/named?fuzzy=' . urlencode($cardName);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $response = curl_exec($ch);
                curl_close($ch);
                $cardData = json_decode($response, true);
                $price = $cardData['prices']['eur'];
                $card = new Card($amount, $cardName, $price);
                $cardArray[] = $card;
            }
        }
        return $cardArray;
    }
    public function calculatePrice($cards) : ?float
    {
        $totalPrice = 0;
        foreach ($cards as $card) {
            $totalPrice += $card->getPrice() * $card->getAmount();
        }
        return $totalPrice;
    }
    public function addCard($deckId, $cardName, $amount) : void
    {
        $this->deckRepository->addCard($deckId, $cardName, $amount);
        header('Location: /deck?id=' . $deckId);
    }
    public function deleteCard($deckId, $cardName) : void
    {

        $this->deckRepository->deleteCard($deckId, $cardName);
    }
    public function updateAmount($deckId, $cardName, $amount) : void
    {
        $this->deckRepository->updateAmount($deckId, $cardName, $amount);
    }
    public function deleteDeck($deckId) : void
    {
        $this->deckRepository->deleteDeck($deckId);
    }
    public function getDeckName($deckId) : ?string
    {
        $deckName = $this->deckRepository->getDeckName($deckId);
        if (!$deckName) {
            return null;
        }
        return $deckName;
    }

}