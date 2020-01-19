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

$phone = new Phone($db);

$phone->id = $_POST['id'];
$phone->displayType = $_POST['displayType'];
$phone->displayResolution = $_POST['displayResolution'];
$phone->displaySize = $_POST['displaySize'];
$phone->selfieCamera = $_POST['selfieCamera'];
$phone->mainCamera = $_POST['mainCamera'];
$phone->technology = $_POST['technology'];
$phone->weight = $_POST['weight'];
$phone->sound = $_POST['sound'];
$phone->productionYear = $_POST['productionYear'];
$phone->os = $_POST['os'];
$phone->battery = $_POST['battery'];
$phone->imgSource = $_POST['imgSource'];


if ($phone->edit()) {
    echo json_encode(
        array('message' => 'Phone updated!')
    );
    header("Location: http://localhost:3000/admin");
} else {
    header("Location: http://localhost:3000/edit-phone");
}

