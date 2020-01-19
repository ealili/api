<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Administrator.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate phone object
$administrator = new Administrator($db);

//$username = isset($_GET['username']) ? $_GET['username'] : die();
$username = $_POST['username'] ;


if ($administrator->remove($username)) {
    echo json_encode(
        array('message' => 'User removed!')
    );
    header("Location: http://localhost:3000/admin");
} else {
    header("Location: http://localhost:3000/admin/remove-administrator.php");
}

