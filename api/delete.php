<?php
// Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
// Folder/File Imports
    include_once '../config/database.php';
    include_once '../models/note.php';

// Initialize Database Connection
    $database =  new Database();
    $db = $database->openConnection();

// Initialize Note model
    $initNote = new Note($db);

// Get Json Input
    $data = json_decode(file_get_contents('php://input'));

// Assign input parameter to model attributes
    $initNote->id = $data->id;

// Run DELETE operation-query
    if ($initNote->deleteNote()){
        echo "Note $data->id deleted.";

    } else{
        echo "Unable to delete Note $data->id";
    }

    
