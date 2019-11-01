<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../config/Database.php';
    include_once '../models/Manufacturer.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    $manufacturer = new manufacturer($db);

    $result = $manufacturer->readManufacturerNames();


    // Get row count
    $num = $result->rowCount();

    // Check if there is any manufacturer
    if ($num > 0) {
        // manufacturer array
        $manArray  = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $manItem = array(
                "mname" => $mname,
                "headquarters" => $headquarters
            );

            // Push
            array_push($manArray, $manItem);
        }

        // Turn to JSON & output
        echo json_encode($manArray);

    } else {
        // No manufacturers found
        echo json_encode(array('message' => 'No manufacturer names found!'));
    }