<?php

session_start();
require_once '../database/Dao.php';

$dao = new Dao();

if(isset($_POST["create_username"])){

    //Verify birthday - at least 13 yrs old
    //Verify email - regex
    //hash password - hash($string, "sha256")

    $response = $dao->createNewUser($_POST["create_username"], 
    $_POST["create_password"], 
    $_POST["create_email"], 
    $_POST["create_birthday"]);

    if($response == "username in use" ){
        $_SESSION['prev_info'] = json_encode($_POST);
        $_SESSION['message'] = "Failed to create user, Username taken";
        $_SESSION['failure'] = "username";
        header("Location: ../login.php", true, 406);
        die();
    }

    $_SESSION["response"] = json_encode($response);
}

if(isset($_POST["login_username"])){
    $response = $dao->getLoginInformation($_POST["login_username"]);
    //VERIFY LOGIN INFORMATION
    if($_POST["login_password"] == $response[0]["user_password"]){
        $_SESSION['user_id']= $response[0]['user_id'];
    } else {
        $_SESSION["prev_info"] = json_encode($_POST);
        $_SESSION['message'] = "Failed to login, no matching password and username";
        header("Location: ../login.php", true, 406);
        die();
    }
}

header("Location: ../account.php", true, 302);
die();
