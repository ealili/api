<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

session_start();

include_once '../config/Database.php';
include_once '../models/Administrator.php';


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$administrator = new Administrator($db);


// get the parameter
// $username = isset($_POST['username']) ? $_POST['username'] : die();
// $password = isset($_POST['password']) ? $_POST['password'] : die();

/* $administrator->username=data*/
$data = json_decode(file_get_contents("php://input"));

$result = $administrator->readAdmin($data->username, md5($data->password));

if ($result->rowCount() != 0) {
    // Post array
    $admin_array = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $admin_item = array(
            'name' => $name,
            'username' => $username,
            //'password' => $password
            //setcookie("username", $username, time()+ 10)
            $_SESSION['newsession']=$username
        );
        $_SESSION['newsession']=$username;

        // Push
        array_push($admin_array, $admin_item);
    }

    // turn to json output
    echo json_encode($admin_array);
} else {
    echo json_encode(array());
}
