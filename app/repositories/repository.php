<?php

namespace Repositories;

use PDO;
use PDOException;

class Repository
{
    public static $connection;

    function __construct()
    {
        require __DIR__ . '/../dbconfig.php';

        try {
            self::$connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

            // set the PDO error mode to exception
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Something went wrong with the database connection, please try again." . $e->getMessage();
        }
    }
}
