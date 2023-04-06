<?php
namespace Repositories;
use PDO;
use PDOException;

class RegisterRepository extends Repository
{
    public function register($username, $password) : void
    {
        try {
            $stmt = $this::$connection->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function checkUniqueUsername($username) : bool
    {
        try {
            $stmt = $this::$connection->prepare("SELECT username FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch();
            if($user != null){
                return false;
            }
            return true;
        } catch (PDOException $e) {
            echo $e;
        }
    }

}