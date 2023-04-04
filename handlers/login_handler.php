<?php

require_once '../database/Dao.php';

function validate_birthday($birthday){
    $birthdate_time = new DateTime($birthday);
    $today = new DateTime(date('yyyy-mm-dd'));
    $age = $today->diff($birthdate_time);
    if($age->y < 16){
        return false;
    }
    return true;
}

$dao = new Dao();

if(isset($_POST["create_username"])){

    //Verify birthday - at least 13 yrs old
    //Verify email - regex
    //hash password - hash($string, "sha256")
    $passwordHash = hash("sha256", $_POST['create_password']);
    $verifyHash = hash("sha256", $_POST['create_validate_password']);

    if($passwordHash != $verifyHash){
        $_SESSION["message"]["password"] = "Passwords do not match";
        $_SESSION["failure"]["password"] = "password";
    }

    $email_regex = file_get_contents("../files/email_regex");

    if(preg_match($email_regex, $_POST['create_email']) != 1){
            $_SESSION['message']["email"] = "invalid email address";
            $_SESSION['failure']["email"] = "email";
    }

    if(!validate_birthday($_POST['create_birthday'])){
        if(isset($_SESSION['message'])){
            $_SESSION['message']["birthday"] = "Invalid Birthday";
            $_SESSION['failure']["birthday"] = "birthday";
        }
    }

    if(isset($_SESSION['failure'])){
        $_SESSION['prev_info'] = json_encode($_POST);
        $_SESSION['create'] = true;
        header("Location: ../login.php", 302);
        die();
    }


    $response = $dao->createNewUser($_POST["create_username"], 
    $_POST["create_password"], 
    $_POST["create_email"], 
    $_POST["create_birthday"]);

    if($response == "username in use" ){
        $_SESSION['prev_info'] = json_encode($_POST);
        $_SESSION['message'] = "Failed to create user, Username taken";
        $_SESSION['failure'] = ["username" => "username"];
        $_SESSION['create'] = true;
        header("Location: ../login.php", true, 302);
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
	    $_SESSION['response'] = json_encode($response);
        $_SESSION['failure']["login"] = "password";
        $_SESSION['message']["login"] = "Failed to login, no matching password and username";
        header("Location: ../login.php", true, 302);
        die();
    }
}

header("Location: ../account.php", true, 302);
die();
