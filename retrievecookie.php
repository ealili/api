<?php
session_start();

if(isset($_SESSION['newsession'])) {
    $print='Everything is working!';
}else{
    $print='Everything is not working!';
    //header("http://localhost:3000/login");
    $redirect=true;
}

echo json_encode($redirect);
