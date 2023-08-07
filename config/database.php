<?php
// Database Model
class Database{
    private $server = "mysql:host=127.0.0.1;dbname=todolistphp";
    private $dbUser='seyiadel'; 
    private $dbPassword ='Adeleye+emi12' ; 
    private $dbPort = ''; 
     
    protected $conn;

    public function openConnection(){
        try{
            $this->conn = new PDO($this->server, $this->dbUser, $this -> dbPassword);
            return  $this->conn;
            echo "Database Connected Successfully";
        }
        catch (PDOException $pdoException){
            echo "Connection Failed ". $pdoException ->getMessage();
        }

    }

    public function closeConnection(){
        $this -> conn = null;
    }
}