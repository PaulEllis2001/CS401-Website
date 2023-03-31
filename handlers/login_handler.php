<?php
require_once '../database/Dao.php';

$dao = new Dao();

if(isset($_POST["create_username"])){
    $dao->createNewUser($_POST["create_username"], 
    $_POST["create_password"], 
    $_POST["create_email"], 
    $_POST["create_birthday"]);
}

if(isset($_POST["login_username"])){
    $dao->getLoginInformation($_POST["login_username"]);
    //VERIFY LOGIN INFORMATION
}

header("Location: ../account.php", true, 302);
die();