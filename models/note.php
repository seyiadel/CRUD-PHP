<?php

class Note{
    // Database Connection
    private $conn;
    //  Database Table
    private $db_table = "Note";

    //Model Columns - Attributes
    public $id;
    public $title;
    public $body;
    public $created_at;

    public function __construct($db){
        $this->conn = $db;
    }

    // CREATE
    public function createNote(){
       $sqlQuery = "INSERT INTO ". $this->db_table ." SET title = :title, body = :body, created_at = :created_at";
       
       $stmt=$this->conn->prepare($sqlQuery);

       $stmt -> bindParam(":title", $this->title);
       $stmt -> bindParam(":body", $this->body);
       $stmt -> bindParam(":created_at", $this->created_at);
       
       if ($stmt->execute()){
        return true;
       }
        return false;
    }

    // GET ALL
    public function getAllNotes(){
        $sqlQuery = "SELECT * FROM ". $this->db_table ."";
        $sqlInnit = $this->conn->prepare($sqlQuery);
        $sqlInnit->execute();
        return $sqlInnit;

    }

    // GET A NOTE - READ
    public function getSingleNote(){
        $sqlQuery = "SELECT id, title, body, created_at FROM ". $this->db_table ." WHERE id = ? LIMIT 0,1";
        $sqlInnit = $this->conn->prepare($sqlQuery);
        $sqlInnit->bindParam(1,$this->id);
        $sqlInnit->execute();
        
        $dataRow = $sqlInnit->fetch(PDO::FETCH_ASSOC);

        $this->title = $dataRow['title'];
        $this->body = $dataRow['body'];
        $this->created_at = $dataRow['created_at'];


    }

    public function updateSingleNote(){
        $sqlQuery = "UPDATE ". $this->db_table ." SET title = :title, body = :body, created_at = :created_at WHERE id = :id";

        $sqlInnit = $this->conn->prepare($sqlQuery);


        $sqlInnit->bindParam(":title", $this->title);
        $sqlInnit->bindParam(":body", $this->body);
        $sqlInnit->bindParam(":created_at", $this->created_at);
   
        if ($sqlInnit->execute()){
            return true;
        }
        return false;
    }

    public function deleteNote(){
        $sqlQuery = "DELETE FROM ". $this -> db_table ." WHERE id = ?";
        $sqlInnit = $this->conn->prepare($sqlQuery);

        $sqlInnit->bindParam(1, $this->id);

        if($sqlInnit->execute()){
            return true;
        }
        return false;

    }
 

}