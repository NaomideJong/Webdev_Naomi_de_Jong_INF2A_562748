<?php

namespace Repositories;

class AccountRepository extends Repository
{

    public function getDecks(): array
    {
        $stmt = $this::$connection->prepare('SELECT id, name, thumbnail FROM decks WHERE user_id = :user_id ORDER BY id DESC');
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}