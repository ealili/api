<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

    include_once '../config/Database.php';
    include_once '../models/Manufacturer.php';
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $manufacturer = new Manufacturer($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $manufacturer->headquarters = $data->headquarters;
    $manufacturer->mname = $data->mname;

    // Create Category
    if($manufacturer->create()) {
        echo json_encode(
            array('message' => 'Category Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Created')
        );
    }
