<?php
session_start();
require_once '../database/Dao.php';

$dao = new Dao();

if(isset($_POST["create_username"])){
    $response = $dao->createNewUser($_POST["create_username"], 
    $_POST["create_password"], 
    $_POST["create_email"], 
    $_POST["create_birthday"]);

    setcookie("response", $response);
}

if(isset($_POST["login_username"])){
    $response = $dao->getLoginInformation($_POST["login_username"]);
    //VERIFY LOGIN INFORMATION
    $_SESSION["response"] = json_encode($response);
}

header("Location: ../account.php", true, 302);
die();
