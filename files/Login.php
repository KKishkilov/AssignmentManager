<?php


class Login
{
    private static $hasLoggedIn = false;
    private static $database = null;
    public function __construct()
    {
        self::$hasLoggedIn = (isset($_SESSION['has_logged_in']) && $_SESSION['has_logged_in'] == true) ?  true : false;
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
        self::$database = $this->connection;

    }

    public static function getConnection()
    {
        if (self::$database == null)
        {
            self::$database = new Database();
        }

        return self::$database;
    }

    public static function login()
    {
        if(self::$hasLoggedIn){
            return true;
        }else{
            require_once '../login.php';
            exit();
        }
    }

    public function getUser($username, $password){
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username=:username");
        $stmt->execute(['username' => $username]);
        return password_verify($password,$stmt->fetch()['password']);
    }

    public static function register($username, $password)
    {
        $errors = [];
        if(self::$hasLoggedIn){
            header('Location: login.php');
        }else{
            echo 'in else statement';
            //check if the user is already registered
            $checkUserStatement = self::getConnection()->getConnection()->prepare("SELECT * FROM users  WHERE username=:username AND password=:password");
            // if(!$checkUserStatement->execute(['username' => $username, 'password' => $password])){
            //     var_dump($checkUserStatement->execute(['username' => $username, 'password' => $password]));die;
                $stmt = self::getConnection()->getConnection()->prepare("INSERT INTO users(username, password) VALUES (:username,:password)");
                return $stmt->execute(['username' => $username, 'password' => $password]);
            // }else{
            //      $errors['username'] = 'Username already exists. Please try again with a different one';
            // }
        
        }
    }
}