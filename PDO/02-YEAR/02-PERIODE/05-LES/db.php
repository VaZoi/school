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
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function registerUser($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            $stmt->execute();

            echo "User successfully registered." . PHP_EOL;
        } catch (PDOException $e) {
            die("Registration failed: " . $e->getMessage());
        }
    }

    public function loginUser($username, $password) {
        $sql = "SELECT user_id, username, password FROM users WHERE username = :username";
    
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
    
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                return $user['user_id'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    public function logoutUser() {
        session_start();
        session_unset();
        session_destroy();
    }

    public function insertProduct($product_image, $product_naam, $product_beschrijving) {
        $sql = "INSERT INTO producten (image, naam, beschrijving) VALUES (:image, :naam, :beschrijving)";
        
        try {
            $stmt = $this->dbh->prepare($sql);

            $stmt->bindParam(':image', $product_image);
            $stmt->bindParam(':naam', $product_naam);
            $stmt->bindParam(':beschrijving', $product_beschrijving);

            $stmt->execute();

            echo "Data successfully inserted into the database" . PHP_EOL;
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }

    public function selectProducten($id = null) {
        try {
            if ($id !== null) {
                $sql = "SELECT * FROM producten WHERE id = :id";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(':id', $id);
            } else {
                $sql = "SELECT * FROM producten";
                $stmt = $this->dbh->query($sql);
            }
    
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }
    
    public function editProduct($product_id, $new_product_image, $new_product_naam, $new_product_beschrijving) {
        try {
            $sql = "UPDATE producten SET image = :image, naam = :naam, beschrijving = :beschrijving WHERE ID = :ID";
            $stmt = $this->dbh->prepare($sql);

            $stmt->bindParam(':ID', $product_id);
            $stmt->bindParam(':image', $new_product_image);
            $stmt->bindParam(':naam', $new_product_naam);
            $stmt->bindParam(':beschrijving', $new_product_beschrijving);

            $stmt->execute();

            echo "Data successfully updated in the database" . PHP_EOL;
        } catch (PDOException $e) {
            die("Update failed: " . $e->getMessage());
        }
    }

    public function deleteProduct($id) {
        try {
            $sql = "DELETE FROM producten WHERE ID = :ID";
            $stmt = $this->dbh->prepare($sql);
    
            $stmt->bindParam(':ID', $id);
    
            $stmt->execute();
    
            echo "Data successfully deleted from the database" . PHP_EOL;
        } catch (PDOException $e) {
            die("Delete failed: " . $e->getMessage());
        }
    }

}
?>