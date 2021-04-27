<?php
class DBConnector {

    private $servername;
    private $username ;
    private $password ;
    private $dbname ;
    private $charset;
    private $connection=false;

    protected function connect() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";
        $this->dbname = "unitedconstuctiongroup";
        $this->charset = "utf8mb4";

        try{
            $DSN="mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
            $pdo = new PDO($DSN,$this->username,$this->password);
            //ATTR_ERRMODE - error reporting https://www.php.net/manual/en/pdo.setattribute.php
            //EERMODE_EXCEPTION - throw exceptions
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
            $this->connection = true;
        } catch(PDOException $e){
            echo "Connection failed: ". $e->getMessage();

        }

    }
}