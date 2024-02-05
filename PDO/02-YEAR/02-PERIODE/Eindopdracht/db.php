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
        $this->database = 'vzrent';
        $this->port = 3306;
    
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->database";
        try {
            $this->dbh = new PDO($dsn, $this->username, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            die("Sorry, something went wrong. Please try again later.");
        }
        
        
    }

    public function registerUser($voornaam, $achternaam, $email, $telefoonnummer, $geboortedatum, $adres, $Password) {
        $sql = "INSERT INTO gebruikers (Voornaam, Achternaam, Email, Telefoonnummer, Geboortedatum, Adres, Wachtwoord) VALUES (:Voornaam, :Achternaam, :Email, :Telefoonnummer, :Geboortedatum, :Adres, :Wachtwoord)";
    
        try {
            $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
    
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":Voornaam", $voornaam);
            $stmt->bindParam(":Achternaam", $achternaam);
            $stmt->bindParam(":Email", $email);
            $stmt->bindParam(":Telefoonnummer", $telefoonnummer);
            $stmt->bindParam(":Geboortedatum", $geboortedatum);
            $stmt->bindParam(":Adres", $adres);
            $stmt->bindParam(":Wachtwoord", $hashedPassword);
            

    
            $stmt->execute();
        } catch (PDOException $e) {
            die("Registration failed: " . $e->getMessage());
        }
    }
    
    public function loginUser($email, $password) {
        $sql = "SELECT * FROM gebruikers WHERE Email = :Email";
        
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":Email", $email);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['Wachtwoord'])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Login failed: " . $e->getMessage());
        }
    }

    public function getUserByID($gebruiker_id) {
        $sql = "SELECT * FROM gebruikers WHERE gebruiker_id = :gebruiker_id";

        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":gebruiker_id", $gebruiker_id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching user by ID: " . $e->getMessage());
        }
    }
    
    
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM gebruikers WHERE Email = :Email";

        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(":Email", $email);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching user by email: " . $e->getMessage());
        }
    }
    

    public function admin() {
        $queryUserCount = "SELECT COUNT(*) AS user_count FROM gebruikers WHERE type = 'klant'";
        $stmtUserCount = $this->dbh->query($queryUserCount);
        $userCountResult = $stmtUserCount->fetch(PDO::FETCH_ASSOC);
    
        $queryRentCount = "SELECT COUNT(*) AS rent_count FROM bookings";
        $stmtRentCount = $this->dbh->query($queryRentCount);
        $rentCountResult = $stmtRentCount->fetch(PDO::FETCH_ASSOC);
    
        $queryAutoCount = "SELECT COUNT(*) AS auto_count FROM autos";
        $stmtAutoCount = $this->dbh->query($queryAutoCount);
        $autoCountResult = $stmtAutoCount->fetch(PDO::FETCH_ASSOC);
    
        $queryLocatieCount = "SELECT COUNT(*) AS locatie_count FROM locaties";
        $stmtLocatieCount = $this->dbh->query($queryLocatieCount);
        $locatieCountResult = $stmtLocatieCount->fetch(PDO::FETCH_ASSOC);
    
        return [
            'user_count' => $userCountResult['user_count'],
            'rent_count' => $rentCountResult['rent_count'],
            'auto_count' => $autoCountResult['auto_count'],
            'locatie_count' => $locatieCountResult['locatie_count'],
        ];
    }
    
    
    public function selectbookings($id = null) {
        try {
            if ($id !== null) {
                $sql = "SELECT * FROM bookings WHERE Boekings_ID = :Boekings_ID";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(':Boekings_ID', $id);
            } else {
                $sql = "SELECT * FROM bookings";
                $stmt = $this->dbh->query($sql);
            }
    
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if (!$result) {
                die("No rows found in the bookings table.");
            }
            var_dump($result);
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }

    public function selectcarID() {
        $sql = "SELECT Auto_ID FROM autos";
        $stmt = $this->dbh->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    public function selectklantID() {
        $sql = "SELECT gebruiker_id FROM gebruikers Where type == 'klant";
        $stmt = $this->dbh->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectInleverlocatie() {
        $sql = "SELECT naam FROM locaties";
        $stmt = $this->dbh->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function selectmedewerkers($id = null) {
        try {
            if ($id !== null) {
                $sql = "SELECT * FROM gebruikers WHERE type == 'admin'";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(':gebruiker_id', $id);
            } else {
                $sql = "SELECT * FROM gebruikers Where type == 'admin'";
                $stmt = $this->dbh->query($sql);
            }
    
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }

    public function addMedewerker($voornaam, $achternaam, $email, $telefoonnummer, $geboortedatum, $adres, $wachtwoord, $type) {
        $sql = "INSERT INTO gebruikers (Voornaam, Achternaam, Email, Telefoonnummer, Geboortedatum, Adres, Wachtwoord, type) 
                VALUES (:voornaam, :achternaam, :email, :telefoonnummer, :geboortedatum, :adres, :wachtwoord, :type)";
        
        try {
            $stmt = $this->dbh->prepare($sql);
    
            $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);
    
            $stmt->bindParam(':voornaam', $voornaam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefoonnummer', $telefoonnummer);
            $stmt->bindParam(':geboortedatum', $geboortedatum);
            $stmt->bindParam(':adres', $adres);
            $stmt->bindParam(':wachtwoord', $hashedPassword);
            $stmt->bindParam(':type', $type);
    
            $stmt->execute();
    
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }
    
    public function addKlant($voornaam, $achternaam, $email, $telefoonnummer, $geboortedatum, $adres, $reserveringsgeschiedenis, $wachtwoord) {
        $sql = "INSERT INTO gebruikers (Voornaam, Achternaam, Email, Telefoonnummer, Geboortedatum, Adres, Reserveringsgeschiedenis, Wachtwoord) 
                VALUES (:voornaam, :achternaam, :email, :telefoonnummer, :geboortedatum, :adres, :reserveringsgeschiedenis, :wachtwoord)";
        
        try {
            $stmt = $this->dbh->prepare($sql);
    
            $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);
    
            $stmt->bindParam(':voornaam', $voornaam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefoonnummer', $telefoonnummer);
            $stmt->bindParam(':geboortedatum', $geboortedatum);
            $stmt->bindParam(':adres', $adres);
            $stmt->bindParam(':reserveringsgeschiedenis', $reserveringsgeschiedenis);
            $stmt->bindParam(':wachtwoord', $hashedPassword);
            $stmt->bindParam(':type', $type);
    
            $stmt->execute();
    
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }
    
    
    public function selectklanten($id = null) {
        try {
            if ($id !== null) {
                $sql = "SELECT * FROM gebruikers WHERE gebruiker_id = :gebruiker_id";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(':gebruiker_id', $id);
            } else {
                $sql = "SELECT * FROM gebruikers WHERE type == 'klant'";
                $stmt = $this->dbh->query($sql);
            }
    
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }
    

    public function selectautos($id = null) {
        try {
            if ($id !== null) {
                $sql = "SELECT * FROM autos WHERE Auto_ID = :Auto_ID";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(':Auto_ID', $id);
            } else {
                $sql = "SELECT * FROM autos";
                $stmt = $this->dbh->query($sql);
            }
    
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }
    
    public function addauto($merk, $model, $bouwjaar, $kenteken, $kleur, $zitcapaciteit, $brandstoftype, $beschikbaarheid, $kilometerstand, $afbeelding) {
        $beschikbaarheid = true;
        $sql = "INSERT INTO autos (Merk, Model, Bouwjaar, Kenteken, Kleur, Zitcapaciteit, Brandstoftype, Beschikbaarheid, Kilometerstand, Afbeelding) 
                VALUES (:Merk, :Model, :Bouwjaar, :Kenteken, :Kleur, :Zitcapaciteit, :Brandstoftype, :Beschikbaarheid, :Kilometerstand, :Afbeelding)";
        
        try {
            $stmt = $this->dbh->prepare($sql);
    
            $stmt->bindParam(':Merk', $merk);
            $stmt->bindParam(':Model', $model);
            $stmt->bindParam(':Bouwjaar', $bouwjaar);
            $stmt->bindParam(':Kenteken', $kenteken);
            $stmt->bindParam(':Kleur', $kleur);
            $stmt->bindParam(':Zitcapaciteit', $zitcapaciteit);
            $stmt->bindParam(':Brandstoftype', $brandstoftype);
            $stmt->bindParam(':Beschikbaarheid', $beschikbaarheid);
            $stmt->bindParam(':Kilometerstand', $kilometerstand);
            $stmt->bindParam(':Afbeelding', $afbeelding);
    
            $stmt->execute();

        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }

    public function calculateBookingCost($opDatum, $inDatum) {
        $startDate = new DateTime($opDatum);
        $endDate = new DateTime($inDatum);
    
        $diffInDays = $startDate->diff($endDate)->days;
    
        $dailyCost = 65;
       
        $totalCost = $dailyCost * $diffInDays;
    
        return $totalCost;
    }

    public function insertBooking($klantID, $autoID, $opDatum, $inDatum, $oplocatie, $inlocatie, $Status) {
        $kosten = $this->calculateBookingCost($opDatum, $inDatum);
        $displayPrice = number_format($kosten, 2);

        $this->updateAutoAvailability($autoID, false);

        $sql = "INSERT INTO bookings (Klant_ID, Auto_ID, Ophaaldatum, Inleverdatum, Ophaallocatie, Inleverlocatie, Status, Kosten) 
                VALUES (:klantID, :autoID, :opDatum, :inDatum, :oplocatie, :inlocatie, :Status, :kosten)";

        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':klantID', $klantID);
            $stmt->bindParam(':autoID', $autoID);
            $stmt->bindParam(':opDatum', $opDatum);
            $stmt->bindParam(':inDatum', $inDatum);
            $stmt->bindParam(':oplocatie', $oplocatie);
            $stmt->bindParam(':inlocatie', $inlocatie);
            $stmt->bindParam(':Status', $Status);
            $stmt->bindParam(':kosten', $kosten);

            $stmt->execute();

            return $displayPrice;
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }
    
    public function updateAutoAvailability($autoID, $availability) {
        $sql = "UPDATE autos SET Beschikbaarheid = :availability WHERE Auto_ID = :Auto_ID";
    
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':Auto_ID', $autoID);
            $stmt->bindParam(':availability', $availability, PDO::PARAM_BOOL);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Update failed: " . $e->getMessage());
        }
    }

    public function selectlocaties($id = null) {
        try {
            if ($id !== null) {
                $sql = "SELECT * FROM locaties WHERE LocationID = :LocationID";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(':LocationID', $id);
            } else {
                $sql = "SELECT * FROM locaties";
                $stmt = $this->dbh->query($sql);
            }
    
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }

    public function insertLocatie($naam, $adres, $telefoonnummer) {
        $sql = "INSERT INTO locaties (naam, Adres, telefoonnummer) 
                VALUES (:naam, :Adres, :telefoonnummer)";
        
        try {
            $stmt = $this->dbh->prepare($sql);
    
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':Adres', $adres);
            $stmt->bindParam(':telefoonnummer', $telefoonnummer);
    
            $stmt->execute();

        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }

    public function getLastInsertId() {
        return $this->dbh->lastInsertId();
    }

    public function getBookingHistory($klant_id) {
        $sql = "SELECT * FROM bookings WHERE Klant_ID = :klant_id";
        
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':klant_id', $klant_id);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }
}
?>