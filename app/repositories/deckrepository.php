<?php

namespace Repositories;
use PDO;
class DeckRepository extends Repository
{

    public function newDeck($name, $decklist, $thumbnail) : int
    {
        $deckId = $this->insertDeck($name, $thumbnail);

        $cards = explode("\n", $decklist);
        foreach ($cards as $cardLine) {
            $cardLine = filter_var(trim($cardLine), FILTER_SANITIZE_SPECIAL_CHARS);
            if (empty($cardLine) || !preg_match('/^\d+/', $cardLine)) {
                // ignore empty lines and lines that don't start with a number
                continue;
            }
            $parts = preg_split('/\s+/', $cardLine, 2);
            $amount = intval($parts[0]);
            $cardName = trim($parts[1]);
            $card = $this->getCardByName($cardName);
            if (!$card) {
                // ignore cards that don't exist in the API
                continue;
            }
            $this->insertDeckCard($deckId, $card['name'], $amount);
        }

        return $deckId;
    }

    private function insertDeck($name, $thumbnail) : ?int
    {
        // Insert new deck into decks table
        $stmt = $this::$connection->prepare('INSERT INTO decks (name, user_id, thumbnail) VALUES (:name, :user_id, :thumbnail)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':thumbnail', $thumbnail);
        $stmt->execute();
        return $this::$connection->lastInsertId();
    }
    private function insertDeckCard($deckId, $cardName, $amount) : void
    {
        // Check if card is already in deck
        $stmt = $this::$connection->prepare('SELECT amount FROM deck_cards WHERE deck_id = :deck_id AND card_name = :card_name');
        $stmt->bindParam(':deck_id', $deckId);
        $stmt->bindParam(':card_name', $cardName);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Card is already in deck, update amount
            $newAmount = $row['amount'] + $amount;
            $stmt = $this::$connection->prepare('UPDATE deck_cards SET amount = :amount WHERE deck_id = :deck_id AND card_name = :card_name');
            $stmt->bindParam(':amount', $newAmount);
            $stmt->bindParam(':deck_id', $deckId);
            $stmt->bindParam(':card_name', $cardName);
            $stmt->execute();
        } else {
            // Card is not in deck, insert new row
            $stmt = $this::$connection->prepare('INSERT INTO deck_cards (deck_id, card_name, amount) VALUES (:deck_id, :card_name, :amount)');
            $stmt->bindParam(':deck_id', $deckId);
            $stmt->bindParam(':card_name', $cardName);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();
        }
    }

    private function getCardByName($cardName): ?array
    {
        //check if the card exists
        $url = 'https://api.scryfall.com/cards/named?fuzzy=' . urlencode($cardName);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $cardData = json_decode($response, true);
        if (isset($cardData['object']) && $cardData['object'] === 'card') {
            return $cardData;
        }
        return null;
    }

    public function getDeck($deckId) : ?array
    {
        $stmt = $this::$connection->prepare('SELECT * FROM decks WHERE id = :id');
        $stmt->bindParam(':id', $deckId);
        $stmt->execute();
        $deck = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$deck) {
            return null;
        }

        $stmt = $this::$connection->prepare('SELECT * FROM deck_cards WHERE deck_id = :deck_id');
        $stmt->bindParam(':deck_id', $deckId);
        $stmt->execute();
        $deckCards = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $deckCards;
    }
    public function getDeckName($deckId) : ?string
    {
        $stmt = $this::$connection->prepare('SELECT name FROM decks WHERE id = :id');
        $stmt->bindParam(':id', $deckId);
        $stmt->execute();
        $deckName = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$deckName) {
            return null;
        }

        return $deckName['name'];
    }

    public function addCard($deckId, $cardName, $amount) : void{
        $cardName = $this->getCardByName($cardName);
        if(!$cardName){
            return;
        }
        // Check if card is already in deck
        $stmt = $this::$connection->prepare('SELECT amount FROM deck_cards WHERE deck_id = :deck_id AND card_name = :card_name');
        $stmt->bindParam(':deck_id', $deckId);
        $stmt->bindParam(':card_name', $cardName['name']);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Card is already in deck, update amount
            $newAmount = $row['amount'] + $amount;
            $stmt = $this::$connection->prepare('UPDATE deck_cards SET amount = :amount WHERE deck_id = :deck_id AND card_name = :card_name');
            $stmt->bindParam(':amount', $newAmount);
            $stmt->bindParam(':deck_id', $deckId);
            $stmt->bindParam(':card_name', $cardName['name']);
            $stmt->execute();
        } else {
            // Card is not in deck, insert new row
            $stmt = $this::$connection->prepare('INSERT INTO deck_cards (deck_id, card_name, amount) VALUES (:deck_id, :card_name, :amount)');
            $stmt->bindParam(':deck_id', $deckId);
            $stmt->bindParam(':card_name', $cardName['name']);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();
        }
    }
    public function deleteCard($deckId, $cardName) : void{
        $stmt = $this::$connection->prepare('DELETE FROM deck_cards WHERE deck_id = :deck_id AND card_name = :card_name');
        $stmt->bindParam(':deck_id', $deckId);
        $stmt->bindParam(':card_name', $cardName);
        $stmt->execute();
    }

    public function updateAmount($deckId, $cardName, $amount) : void{
        $stmt = $this::$connection->prepare('UPDATE deck_cards SET amount = :amount WHERE deck_id = :deck_id AND card_name = :card_name');
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':deck_id', $deckId);
        $stmt->bindParam(':card_name', $cardName);
        $stmt->execute();
    }
    public function deleteDeck($deckId) : void{
//delete all cards from deck_cards
        $stmt = $this::$connection->prepare('DELETE FROM deck_cards WHERE deck_id = :deck_id');
        $stmt->bindParam(':deck_id', $deckId);
        $stmt->execute();
//delete deck from decks
        $stmt = $this::$connection->prepare('DELETE FROM decks WHERE id = :id');
        $stmt->bindParam(':id', $deckId);
        $stmt->execute();
    }

}