<?php
namespace api\mainController;

use PDO;

final class database
{
    const DSN = "mysql:dbname=comunidade-adv-londrina;host=127.0.0.1;";
    const USER = 'allan';
    const PASS = 'admin';
    private $conn;

    public function __construct()
    {
        $this->conn = new PDO(self::DSN, self::USER, self::PASS, [PDO::ATTR_PERSISTENT => true]);
    }

    public function QUERY_EXE($query){ //$params =null
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ROW_COUNT($query){
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }
}