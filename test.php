<?php
require_once './database/Dao.php';

$dao = new Dao();

$result = $dao->debugUsers();

print_r($result)
?>

<form class="form_box login_box" id="create_account_form" method="POST" action="test.php">
    <lable class="form_item" for="create_username">Select a Username:</lable>
    <input class="form_item" type="text" id="create_username" name="create_username">
    <label class="form_item" for="create_email">Enter an Email:</label>
    <input class="form_item" type="email" id="create_email" name="create_email">
    <label class="form_item" for="create_birthdate">Enter Birthday:</label>
    <input class="form_item" type="date" id="create_birthday" name="create_birthday">
    <label class="form_item" for="create_password">Select a Password:</label>
    <input class="form_item" type="password" id="create_password" name="create_password">
    <label class="form_item" for="create_validate_password">Confirm Password:</label>
    <input class="form_item" type="password" id="create_validate_password" name="create_validate_password">
    <input class="form_item login_button" type="submit" value="Create Account">
</form>

<?php 
    if(isset($_POST["create_birthday"])){
        echo $_POST["create_birthday"];

        $result = $dao->createNewUser($_POST["create_username"], $_POST["create_password"],
        $_POST["create_email"], $_POST["create_birthday"]);

        echo $result;
    }


?>
