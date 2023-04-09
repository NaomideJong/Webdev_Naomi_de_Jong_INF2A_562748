<?php

namespace Repositories;

class CompareRepository extends Repository
{

    public function getAllPreCons() : array
    {
        $stmt = $this::$connection->prepare('SELECT * FROM pre_cons');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getPreConCards($id) : array
    {
        //gets all pre-con cards by pre_con_id
        $stmt = $this::$connection->prepare('SELECT * FROM pre_con_cards WHERE pre_con_id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPreConById($id) : array
    {
        //gets all pre-con cards by pre_con_id
        $stmt = $this::$connection->prepare('SELECT * FROM pre_cons WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    //Put the cards of the json precon in the database
//    public function jsonToCards() {
//        // Load the JSON file
//        $appPath = dirname(dirname(__FILE__));
//        $jsonPath = $appPath . '/public/json/RebellionRising.json';
//        $json = file_get_contents($jsonPath);
//        $data = json_decode($json, true);
//
//        // Insert the pre-con into the database
//        $preConName = 'Rebellion Rising';
//        $preConPrice = '59.95';
//        $preConImage = 'https://cards.scryfall.io/large/front/2/b/2b5df03d-2463-468b-b444-d946eeb1c96d.jpg?1675905561';
//        $stmt = $this::$connection->prepare('INSERT INTO pre_cons (pre_con_name, price, image) VALUES (:pre_con_name, :price, :image)');
//        $stmt->bindParam(':pre_con_name', $preConName);
//        $stmt->bindParam(':price', $preConPrice);
//        $stmt->bindParam(':image', $preConImage);
//        $stmt->execute();
//        $preConId = $this::$connection->lastInsertId();
//
//        // Insert the pre-con cards into the database
//        $stmt = $this::$connection->prepare('INSERT INTO pre_con_cards (pre_con_id, card_name, amount) VALUES (:pre_con_id, :card_name, 1) ON DUPLICATE KEY UPDATE amount = amount + 1');
//        $stmt->bindParam(':pre_con_id', $preConId);
//        $stmt->bindParam(':card_name', $data['data']['commander'][0]['name']);
//        $stmt->execute();
//
//        foreach ($data['data']['mainBoard'] as $name) {
//            $stmt = $this::$connection->prepare('INSERT INTO pre_con_cards (pre_con_id, card_name, amount) VALUES (:pre_con_id, :card_name, 1) ON DUPLICATE KEY UPDATE amount = amount + 1');
//            $stmt->bindParam(':pre_con_id', $preConId);
//            $stmt->bindParam(':card_name', $name['name']);
//            $stmt->execute();
//        }
//    }
}

