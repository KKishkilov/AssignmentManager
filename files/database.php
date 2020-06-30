<?php

require_once dirname(__DIR__).'/config.php';

class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;
    private static $instance = null;

    public function __construct()
    {
        $this->username = DB_USER;
        $this->database = DB_NAME;
        $this->host     = DB_HOST;
        $this->password = DB_PASS;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            die("Connection failed: ".$e->getMessage());
        }
    }

    public static function getInstance(){
        if(self::$instance == null) {           //check if the static property $instance is null
            self::$instance = new self();       //if so, create new Database object and assign it to $instance variable
        }
        return self::$instance;                 //if it's not empty, just return the existing database $instance
    }

    public function getConnection()
    {
        return $this->connection;
    }

}

 

Database::getInstance();