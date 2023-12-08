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
        $this->port = 3307;
    
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->database";
        try {
            $this->dbh = new PDO($dsn, $this->username, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            die("Sorry, something went wrong. Please try again later.");
        }
        
        
    }

    public function registerUser($klantvoornaam, $klantachternaam, $klantemail, $klantpassword, $klantgeboortedatum, $klantadres, $klanttelefoonnummer, $klantrijbewijs) {
        $sql = "INSERT INTO klanten (Voornaam, Achternaam, Email, Password, Geboortedatum, Adres, Telefoonnummer, Rijbewijsnummer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
        try {
            $hashedPassword = password_hash($klantpassword, PASSWORD_DEFAULT);
    
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(1, $klantvoornaam);
            $stmt->bindParam(2, $klantachternaam);
            $stmt->bindParam(3, $klantemail);
            $stmt->bindParam(4, $hashedPassword);
            $stmt->bindParam(5, $klantgeboortedatum);
            $stmt->bindParam(6, $klantadres);
            $stmt->bindParam(7, $klanttelefoonnummer);
            $stmt->bindParam(8, $klantrijbewijs);

    
            $stmt->execute();
        } catch (PDOException $e) {
            die("Registration failed: " . $e->getMessage());
        }
    }
    
    public function loginUser($email, $password) {
        $sql = "SELECT id, type, Password FROM (
            SELECT klant_id AS id, 'klant' AS type, Password, Email FROM klanten
            UNION ALL
            SELECT Medewerker_ID AS id, 'medewerker' AS type, Wachtwoord AS Password, Email FROM medewerkers
        ) AS users WHERE Email = :Email";

    
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':Email', $email);
            $stmt->execute();
    
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                // Debug: Output fetched user data
                var_dump($user);
    
                // Debug: Output hashed password from the database
                var_dump($user['Password']);
    
                // Debug: Output provided password
                var_dump($password);
    
                // Debug: Output result of password verification
                var_dump(password_verify($password, $user['Password']));
    
                if (password_verify($password, $user['Password'])) {
                    return ($user['type'] == 'medewerker') ? 'medewerker:' . $user['id'] : $user['id'];
                } else {
                    // Debug: Output that password verification failed
                    var_dump('Password verification failed');
                    return false;
                }
            } else {
                // Debug: Output that user is not found
                var_dump('User not found');
                return false;
            }
        } catch (PDOException $e) {
            // Debug: Output any database errors
            var_dump('Database Error: ' . $e->getMessage());
            return false;
        }
    }
    
    

    public function admin($userCount, $rentCount, $autoCount, $locatieCount) {
        $queryUserCount = "SELECT COUNT(*) AS user_count FROM klanten";
        $stmtUserCount = $this->dbh->query($queryUserCount);
        $userCount = $stmtUserCount->fetch(PDO::FETCH_ASSOC);
    
        $queryrentCount = "SELECT COUNT(*) AS rent_count FROM bookings";
        $stmtrentCount = $this->dbh->query($queryrentCount);
        $rentCount = $stmtrentCount->fetch(PDO::FETCH_ASSOC);
    
        $queryautoCount = "SELECT COUNT(*) AS auto_count FROM autos";
        $stmtautoCount = $this->dbh->query($queryautoCount);
        $autoCount = $stmtautoCount->fetch(PDO::FETCH_ASSOC);

        $querylocatieCount = "SELECT COUNT(*) AS locatie_count FROM locaties";
        $stmtlocatieCount = $this->dbh->query($querylocatieCount);
        $locatieCount = $stmtlocatieCount->fetch(PDO::FETCH_ASSOC);
    
        return [
            'user_count' => $userCount['user_count'],
            'rent_count' => $rentCount['rent_count'],
            'auto_count' => $autoCount['auto_count'],
            'locatie_count' => $locatieCount['locatie_count'],
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
    
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }

    public function updateAutoBeschikbaarheid($boekingID, $status) {
        $increment = ($status === 'Afgerond' || $status === 'Geannuleerd') ? 1 : -1;
        $sql = "UPDATE autos SET Beschikbaarheid = Beschikbaarheid + :increment WHERE Auto_ID = (SELECT Auto_ID FROM bookings WHERE Boekings_ID = :boekingID)";
        
        try {
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':increment', $increment, PDO::PARAM_INT);
            $stmt->bindParam(':boekingID', $boekingID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Update failed: " . $e->getMessage());
        }
    }
    
    

    public function insertbooking($Boeking_klantID, $Boeking_autoID, $Boeking_Opdatum, $Boeking_Indatum, $Boeking_Oplocatie, $Boeking_Inlocatie, $Boeking_Status, $Boeking_Kost) {
        $Boeking_Kost = $this->calculateBookingCost($Boeking_Opdatum, $Boeking_Indatum);
        $sql = "INSERT INTO bookings (Klant_ID, Auto_ID, Ophaaldatum, Inleverdatum, Ophaallocatie, Inleverlocatie, Status, Kosten) VALUES (:Klant_ID, :Auto_ID, :Ophaaldatum, :Inleverdatum, :Ophaallocatie, :Inleverlocatie, :Status, :Kosten)";
        
        try {
            $stmt = $this->dbh->prepare($sql);
    
            $stmt->bindParam(':Klant_ID', $Boeking_klantID);
            $stmt->bindParam(':Auto_ID', $Boeking_autoID);
            $stmt->bindParam(':Ophaaldatum', $Boeking_Opdatum);
            $stmt->bindParam(':Inleverdatum', $Boeking_Indatum);
            $stmt->bindParam(':Ophaallocatie', $Boeking_Oplocatie);
            $stmt->bindParam(':Inleverlocatie', $Boeking_Inlocatie);
            $stmt->bindParam(':Status', $Boeking_Status);
            $stmt->bindParam(':Kosten', $Boeking_Kost);
    
            $stmt->execute();
    
            $this->updateAutoBeschikbaarheid($this->dbh->lastInsertId(), $Boeking_Status);
    
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }
    

    private function calculateBookingCost($opDatum, $inDatum) {
        $startDate = new DateTime($opDatum);
        $endDate = new DateTime($inDatum);
    
        $diffInDays = $startDate->diff($endDate)->days;
    
        $dailyCost = 120;
        $monthlyCost = 3500;
    
        $totalCost = $dailyCost * $diffInDays;
    
        if ($diffInDays >= 30) {
            $fullMonths = floor($diffInDays / 30);
            $remainingDays = $diffInDays % 30;
    
            $totalCost = $monthlyCost * $fullMonths;
    
            if ($remainingDays > 0) {
                $totalCost += $dailyCost * $remainingDays;
            }
        }
    
        return $totalCost;
    }
    
    

    public function selectcarID() {
        $sql = "SELECT Auto_ID FROM autos";
        $stmt = $this->dbh->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    public function selectklantID() {
        $sql = "SELECT Klant_ID FROM klanten";
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
                $sql = "SELECT * FROM medewerkers WHERE Medewerker_ID = :Medewerker_ID";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(':Medewerker_ID', $id);
            } else {
                $sql = "SELECT * FROM medewerkers";
                $stmt = $this->dbh->query($sql);
            }
    
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }

    public function addMedewerker($voornaam, $achternaam, $email, $functie, $salaris, $telefoonnummer, $adres, $geboortedatum, $toegangsrechten) {
        $sql = "INSERT INTO medewerkers (Voornaam, Achternaam, Email, Wachtwoord, Functie, Salaris, Telefoonnummer, Adres, Geboortedatum, Toegangsrechten) 
                VALUES (:voornaam, :achternaam, :email, :password, :functie, :salaris, :telefoonnummer, :adres, :geboortedatum, :toegangsrechten)";
        
        try {
            $stmt = $this->dbh->prepare($sql);
    
            $hashedPassword = password_hash($functie, PASSWORD_DEFAULT);
    
            $stmt->bindParam(':voornaam', $voornaam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':functie', $functie);
            $stmt->bindParam(':salaris', $salaris);
            $stmt->bindParam(':telefoonnummer', $telefoonnummer);
            $stmt->bindParam(':adres', $adres);
            $stmt->bindParam(':geboortedatum', $geboortedatum);
            $stmt->bindParam(':toegangsrechten', $toegangsrechten);
    
            $stmt->execute();
    
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
        }
    }
    
    
    public function selectklanten($id = null) {
        try {
            if ($id !== null) {
                $sql = "SELECT * FROM klanten WHERE Klant_id = :klant_id";
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindParam(':klant_id', $id);
            } else {
                $sql = "SELECT * FROM klanten";
                $stmt = $this->dbh->query($sql);
            }
    
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }

    public function addKlant($voornaam, $achternaam, $email, $geboortedatum, $adres, $telefoonnummer, $rijbewijsnummer) {
        $existingRecords = $this->select("SELECT * FROM klanten WHERE Email = :email", array(':email' => $email));
    
        if (!empty($existingRecords)) {
            die("Record with the provided email already exists.");
        }
    
        $sql = "INSERT INTO klanten (Voornaam, Achternaam, Email, Geboortedatum, Adres, Telefoonnummer, Rijbewijsnummer) 
                VALUES (:voornaam, :achternaam, :email, :geboortedatum, :adres, :telefoonnummer, :rijbewijsnummer)";
        
        try {
            $stmt = $this->dbh->prepare($sql);
    
            $stmt->bindParam(':voornaam', $voornaam);
            $stmt->bindParam(':achternaam', $achternaam);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':geboortedatum', $geboortedatum);
            $stmt->bindParam(':adres', $adres);
            $stmt->bindParam(':telefoonnummer', $telefoonnummer);
            $stmt->bindParam(':rijbewijsnummer', $rijbewijsnummer);
    
            $stmt->execute();
    
        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
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
    
    public function addauto($merk, $model, $bouwjaar, $kenteken, $kleur, $zitcapaciteit, $brandstoftype, $kilometerstand, $beschikbaarheid, $afbeelding) {
        $sql = "INSERT INTO autos (Merk, Model, Bouwjaar, Kenteken, Kleur, Zitcapaciteit, Brandstoftype, Kilometerstand, Beschikbaarheid, Afbeelding) 
                VALUES (:Merk, :Model, :Bouwjaar, :Kenteken, :Kleur, :Zitcapaciteit, :Brandstoftype, :Kilometerstand, :Beschikbaarheid, :Afbeelding)";
        
        try {
            $stmt = $this->dbh->prepare($sql);
    
            $stmt->bindParam(':Merk', $merk);
            $stmt->bindParam(':Model', $model);
            $stmt->bindParam(':Bouwjaar', $bouwjaar);
            $stmt->bindParam(':Kenteken', $kenteken);
            $stmt->bindParam(':Kleur', $kleur);
            $stmt->bindParam(':Zitcapaciteit', $zitcapaciteit);
            $stmt->bindParam(':Brandstoftype', $brandstoftype);
            $stmt->bindParam(':Kilometerstand', $kilometerstand);
            $stmt->bindParam(':Beschikbaarheid', $beschikbaarheid);
            $stmt->bindParam(':Afbeelding', $afbeelding);
    
            $stmt->execute();

        } catch (PDOException $e) {
            die("Insert failed: " . $e->getMessage());
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

    public function select($query, $params = array()) {
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Select failed: " . $e->getMessage());
        }
    }

    public function getBookingHistory($klant_id) {
        $query = "SELECT * FROM bookings WHERE klant_id = :klant_id";
        $params = array(':klant_id' => $klant_id);
        return $this->select($query, $params);
    }

}
?>