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
    // Blog post query

    $result = $phone->read();



    // Get row count
    $num = $result->rowCount();

    // Check if there is any post
    if ($num > 0) {
        // Post array
        $phone_arr = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $phone_item = array(
                'id' => $id,
                'display_id' => $display_id,
                'camera_id' => $camera_id,
                'mname' => $mname,
                'name' => $name,
                'technology' => $technology,
                'weight' => $weight,
                'sound' => $sound,
                'os' => $os,
                'battery' => $battery,
                'imgSource' => $imgSource,
                'displayType' => $displayType,
                'displayResolution' => $displayResolution,
                'displaySize' => $displaySize,
                'selfieCamera' => $selfieCamera,
                'mainCamera' => $mainCamera
            );

            // Push to "data"
            array_push($phone_arr, $phone_item);
        }

        // Turn to JSON & output
        echo json_encode($phone_arr);

    } else {
        // No phones
        echo json_encode(array('message' => 'No phones found!'));
    }