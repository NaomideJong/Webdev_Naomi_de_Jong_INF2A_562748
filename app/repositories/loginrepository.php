<?php
namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class LoginRepository extends Repository
{

    public function login($username, $password)
    {
        try {
            $stmt = $this::$connection->prepare("SELECT id, username, password 
            FROM users WHERE (username = :username)");

            $stmt->bindParam(':username', $username, PDO::PARAM_STR);

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!empty($user) && password_verify($password, $user['password'])) {
                return $user;
            }
            return null;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
