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

//$id = isset($_GET['id']) ? $_GET['id'] : die();
$id = $_POST['id'] ? $_POST['id'] : die();

if ($phone->delete($id)) {
    echo json_encode(
        array('message' => 'Phone deleted!')
    );
    header("Location: http://localhost:3000/admin");
} else {
    header("Location: http://localhost:3000/admin/delete-phone");
}

