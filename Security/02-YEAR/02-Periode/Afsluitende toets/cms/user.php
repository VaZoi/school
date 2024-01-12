<?php

require 'db.php';

class User 
{
    public $dbh;
    public $table = 'users';

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
        session_start();
    }

    public function hash($password) : string 
    {
    return password_hash($password, PASSWORD_BCRYPT);
    }

    public function all() : array 
    {
        return $this->dbh->run("SELECT * from $this->table")->fetchAll();
    }

    public function first($id) : array 
    {
        return $this->dbh->run("SELECT * from $this->table where id = $id")->fetch();
    }

    public function add($email, $password) : int
    {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        $hash = $this->hash($password);
        $this->dbh->run("INSERT INTO $this->table (email, password) VALUES (?, ?)", [$email, $hash]);
        return $this->dbh->lastId();
    }

    public function edit($email, $password, $id) : PDOStatement 
    {
        $hash = $this->hash($password);
        return $this->dbh->run("UPDATE $this->table SET email ='$email', password = '$hash' WHERE id = $id");
    }

    public function delete($id) : PDOStatement
    {
        return $this->dbh->run("DELETE FROM $this->table where id = $id");
    }

    // Authenticate user
    public function login($email, $password) : bool 
{
    $user = $this->dbh->run("SELECT * FROM $this->table WHERE email = ?", [$email])->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = htmlspecialchars($user['email']);
        return true;
    }
    return false;
}

    // Check if a user is logged in
    public function isLoggedIn() : bool
    {
        return isset($_SESSION['user_id']);
    }

    public function logout() : void
    {
        session_destroy();
        session_start();
    }

    public function generateCsrfToken() : string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }
}

$myDb = new DB();
$user = new User($myDb);