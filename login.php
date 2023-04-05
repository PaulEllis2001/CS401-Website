<?php include("includes/header.php");
require_once"database/Dao.php";
if(!isset($_COOKIE['PHPSESSID'])){
    session_start();
}

$dao = new Dao();

function printErrorMessages($messages){
    $finalString = "";
    foreach($messages as $message){
        $finalString = $finalString . "<h2 class=\"error_message\">" . $message . "</h2>";
    }
    return $finalString;
}

?>
<div class="row_item">
    <div id="create_account_box" class="form_box center_content">
        <h2>Create Account</h2>
        <form class="form_box login_box" id="create_account_form" method="POST" action="handlers/login_handler.php">
            <lable class="form_item" for="create_username">Select a Username:</lable>
            <input class="form_item" value="<?php echo isset($_SESSION['create']) ?  ((array)json_decode($_SESSION['prev_info']))['create_username'] : ""; ?>" type="text" id="create_username" name="create_username">
            <label class="form_item" for="create_email">Enter an Email:</label>
            <input class="form_item" value="<?php echo isset($_SESSION['create']) ?  ((array)json_decode($_SESSION['prev_info']))['create_email'] : ""; ?>" type="email" id="create_email" name="create_email">
            <label class="form_item" for="create_birthdate">Enter Birthday:</label>
            <input class="form_item" value="<?php echo isset($_SESSION['create']) ?  ((array)json_decode($_SESSION['prev_info']))['create_birthday']  : ""; ?>" type="date" id="create_birthday" name="create_birthday">
            <label class="form_item" for="create_password">Select a Password:</label>
            <input class="form_item" type="password" id="create_password" name="create_password">
            <label class="form_item" for="create_validate_password">Confirm Password:</label>
            <input class="form_item" type="password" id="create_validate_password" name="create_validate_password">
            <input class="form_item login_button" type="submit" value="Create Account">
        </form>
    </div>
    <div class="center_content">
        <div>
         <h1>OR</h1>
        </div>
        <div>
            <?php
            if(isset($_SESSION['message'])){
            	echo printErrorMessages($_SESSION['message']);
            }
            ?>
        </div>
    </div>
    <div id="login_box" class="form_box center_content">
        <h2>Login</h2>
        <form class="form_box login_box" id="login_form" method="POST" action="handlers/login_handler.php">
            <label class="form_item" for="login_username">Username:</label>
            <input class="form_item" value="<?php echo isset($_SESSION['failure']['login']) ? ((array)json_decode($_SESSION['prev_info']))['login_username'] : ""; ?>" type="text" id="login_username" name="login_username">
            <label class="form_item" for="login_password">Password:</label>
            <input class="form_item" type="password" id="login_password" name="login_password">
            <input class="form_item login_button" type="submit" value="Login">
        </form>
    </div>
</div>


<?php include("includes/footer.php"); ?>
