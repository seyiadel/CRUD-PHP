<?php
// Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization, X-Requested-With");

// Folder/File Input
    include_once '../config/database.php';
    include_once '../models/note.php';

// Initialize Database
    $database = new Database();
    $db = $database->openConnection();

// Initialize Note
    $initNote = new Note($db);

// Get JSON input
    $data =json_decode(file_get_contents("php://input"));

// Assign input parameters to model attributes
    $initNote->id = $data->id;
    $initNote->title = $data->title;
    $initNote->body = $data->body;
    $initNote->created_at = date('Y-m-d H:i:s');

// Run POST/PUT operation
    if ($initNote->updateSingleNote()){
        echo json_encode("Note updated!");
    } else{
        echo json_encode("Data could not be updated");
        
    }

