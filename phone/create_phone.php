<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../config/Database.php';
    include_once '../models/Phone.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate phone object
    $phone = new Phone($db);

    $stripped = preg_replace('/\s+/', '', $_POST['name']);
    $phone->id = lcfirst($stripped);
    $phone->displayType = $_POST['displayType'];
    $phone->displayResolution = $_POST['displayResolution'];
    $phone->displaySize = $_POST['displaySize'];
    $phone->selfieCamera = $_POST['selfieCamera'];
    $phone->mainCamera = $_POST['mainCamera'];
    $phone->mname = $_POST['mname'];
    $phone->name = $_POST['name'];
    $phone->technology = $_POST['technology'];
    $phone->weight = $_POST['weight'];
    $phone->sound = $_POST['sound'];
    $phone->productionYear = $_POST['productionYear'];
    $phone->os = $_POST['os'];
    $phone->battery = $_POST['battery'];
    $phone->imgSource = $_POST['imgSource'];




    //create phone
    if($phone->create()) {
        echo json_encode(
            array('message' => 'Phone added!')
        );
        header("Location: http://localhost:3000/admin");
    } else {
        header("Location: http://localhost:3000/phones       ");
    }

