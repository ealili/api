<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Phone.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$phone = new Phone($db);

// get the parameter
$id = isset($_GET['id']) ? $_GET['id'] : die();

// Get a single phone object based on 'id' that is passed
$result = $phone->readSinglePhone($id);


// Get row count
$num = $result->rowCount();

// Check if there is a phone
if ($num > 0) {
    // Post array
    $phone_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $phone_item = array(
            'id' => $id,
            'displayType' => $displayType,
            'displayResolution' => $displayResolution,
            'displaySize' => $displaySize,
            'selfieCamera' => $selfieCamera,
            'mainCamera' => $mainCamera,
            'mname' => $mname,
            'name' => $name,
            'technology' => $technology,
            'productionYear' => $productionYear,
            'weight' => $weight,
            'sound' => $sound,
            'os' => $os,
            'battery' => $battery,
            'imgSource' => $imgSource
        );

        // Push
        array_push($phone_arr, $phone_item);
    }

    // Turn to JSON & output
    echo json_encode($phone_arr);

} else {
    // No phone
    echo json_encode(array('message' => 'Phone could not be found!'));
}