<?php

require_once '../database/Dao.php';
$_SESSION = array();
function validate_birthday($birthday){
    $birthdate_time = new DateTime($birthday);
    $today = new DateTime(date('y-m-d'));
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
    $_SESSION['email_regex'] = $email_regex;
    $matches = array();
    preg_match($email_regex, $_POST['create_email'], $matches);
    if($matches == null){
            $_SESSION['message']["email"] = "invalid email address";
            $_SESSION['failure']["email"] = "email" . json_encode($matches) . $email_regex;
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

    if(is_array($response)){
        foreach($response as $emailUsernameFailure){
            $_SESSION['message'][$emailUsernameFailure] = $emailUsernameFailure;
            $_SESSION['failure']['in_use'] .= $emailUsernameFailure;
        }
        $_SESSION['prev_info'] = json_encode($_POST);
        $_SESSION['create'] = true;
        header("Location: ../login.php", true, 302);
        die();
    }


    $_SESSION["response"] = json_encode($response);
}

if(isset($_POST["login_username"])){
    $response = $dao->getLoginInformation($_POST["login_username"]);
    //VERIFY LOGIN INFORMATION
    if(isset($response[0])){
        if($_POST["login_password"] == $response[0]["user_password"]){
            $_SESSION['user_id']= $response[0]['user_id'];
        } else {
            $_SESSION['prev_info'] = json_encode($_POST);
            $_SESSION['response'] = json_encode($response);
            $_SESSION['failure']['login'] = 'password';
            $_SESSION['message']['login'] = 'Failed to login, Username or Password Incorrect';
        }
    } else {
        $_SESSION["prev_info"] = json_encode($_POST);
	    $_SESSION['response'] = json_encode($response);
        $_SESSION['failure']['login'] = 'username';
        $_SESSION['message']['login'] = 'Failed to login, Username or Password Incorrect';
        header("Location: ../login.php", true, 302);
        die();
    }
}

header("Location: ../account.php", true, 302);
die();
