<?php

class Dbh {
    private $host = "localhost";
    private $dbname = "epayment-aenhs";
    private $user = "root";
    private $pwd = "";

    protected function connect() {
        $dsn = 'mysql:host=' . $this->host . '; dbname=' . $this->dbname;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}