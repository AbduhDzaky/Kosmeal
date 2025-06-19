<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "kosmeal";
    private $port = 3307;

    public function getConnection() {
        return new mysqli($this->host, $this->user, $this->pass, $this->dbname, $this->port);
    }
}
