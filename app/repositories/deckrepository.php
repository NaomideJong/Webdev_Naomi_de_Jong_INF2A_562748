<?php

namespace Repositories;
use PDO;
use PDOException;

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
    private function insertDeckCard(int $deckId, string $cardName, int $amount) : void
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

    private function getCardByName(string $cardName): ?array
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

        $deck['cards'] = $deckCards;
        return $deck;
    }

}