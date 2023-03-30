<?php
require_once 'Dao.php';

$dao = new Dao();

if(isset($_POST["create_username"])){
    $dao->createNewUser($_POST["create_username"], 
    $_POST["create_password"], 
    $_POST["create_email"], 
    $_POST["create_birthday"]);
}

header("Location: ../account.php", true, 302);
die();