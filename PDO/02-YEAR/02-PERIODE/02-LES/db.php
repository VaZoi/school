<?php

class database {
    private $host;
    private $username;
    private $password;
    private $database;

    private $port;
    private $dbh;

    public function __construct() {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'test';
        $this->port = 3307;
    
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->database";
        try {
            $this->dbh = new PDO($dsn, $this->username, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connection established" . PHP_EOL;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    public function insert($product_naam, $product_beschrijving) {
        $sql = "INSERT INTO producten (naam, beschrijving) VALUES (:naam, :beschrijving)";
        
        try {
            $stmt = $this->dbh->prepare($sql);

            $stmt->bindParam(':naam', $product_naam);
            $stmt->bindParam(':beschrijving', $product_beschrijving);

            $stmt->execute();

            echo "Data successfully inserted into the database" . PHP_EOL;
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }

}
?>