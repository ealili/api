<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Administrator.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$administrator = new Administrator($db);

$result = $administrator->readAllAdmins();

$num = $result->rowCount();

if ($num != 0) {
    // Post array
    $admin_array = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $admin_item = array(
            'name' => $name,
            'username' => $username,
            //'password' => $password
        );
        // Push
        array_push($admin_array, $admin_item);
    }
    // turn to json output
    echo json_encode($admin_array);
} else {
    echo json_encode(array('message' => 'No administrator found!'));
}
