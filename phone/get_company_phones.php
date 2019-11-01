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

    // Get the parameter
    $mname = isset($_GET['mname']) ? $_GET['mname'] : die();

    // Get phones of a specific company
    $result = $phone->getCompanyPhones($mname);


    // Get row count
    $num = $result->rowCount();

    // Check if there is any phone
    if ($num > 0) {
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
        // No phones
        echo json_encode(array('message' => 'No phones found!'));
    }