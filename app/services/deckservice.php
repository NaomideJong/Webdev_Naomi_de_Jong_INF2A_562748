<?php

namespace Services;
use Repositories\DeckRepository;
use Models\Card;

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
    public function getDeck(int $deckId) : ?array
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
    public function calculatePrice($cards) : float
    {
        $totalPrice = 0;
        foreach ($cards as $card) {
            $totalPrice += $card->getPrice() * $card->getAmount();
        }
        return $totalPrice;
    }
    public function addCard(int $deckId, string $cardName, int $amount) : void
    {
        $this->deckRepository->addCard($deckId, $cardName, $amount);
    }

}