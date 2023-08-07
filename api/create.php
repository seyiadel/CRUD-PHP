<?php
//  Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Conttol-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Folder/Files Imports
    include_once '../config/database.php';
    include_once '../models/note.php';

// Initialize Database
    $database = new Database();
    $db = $database->openConnection();

// Initialize Note
    $newNote =  new Note($db);

// Get Json Input
    $data = json_decode(file_get_contents("php://input"));

// Assign Input parameter to model attributes
    $newNote->title = $data->title;
    $newNote ->body = $data->body;
    $newNote->created_at = date('Y-m-d H:i:s');

// Run CREATE operation-query
    if ($newNote->createNote()){
        echo "Note Created Successfully .";

    }else{
        echo "Unable to create Note .";
    }