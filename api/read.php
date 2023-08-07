<?php
// Headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

// Folder/ File Imports
    include_once '../config/database.php';
    include_once '../models/note.php';

// Initialiize Database
    $database = new Database();
    $db = $database->openConnection();

// Initialize Note
    $initNote = new Note($db);

// Run GET operation-query
    $getNote = $initNote->getAllNotes();
    $noteRowCount = $getNote->rowCount();

    echo json_encode($noteRowCount);
    if($noteRowCount > 0){

        $noteArr = array();
        $noteArr["body"] =array();
        // $noteArr["itemCount"] = $noteRowCount;
        while ($row = $getNote->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "title" => $title,
                "body" => $body,
                "created_at" => $created_at
            );
            array_push($noteArr["body"], $e);

        }
        echo json_encode($noteArr);

    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message"=> "No note found")
        );
    }