<?php include("includes/header.php");?>

<div>
    <div id="login_box">
        <h2>Login</h2>
        <form class="login_form" id="login_form" method="POST" action="handlers/login_handler.php">
            <label for="login_username">Username:</label>
            <input type="text" id="login_username" name="login_username">
            <label for="login_password">Password:</label>
            <input type="password" id="login_password" name="login_password">
            <input type="submit" value="Login">
        </form>
    </div>
    <div id="create_account_box">
        <h2>Create Account</h2>
        <form class="create_account_form" id="create_account_form" method="POST" action="handlers/create_account_handler.php">
            <lable for="create_username">Select a Username</lable>
            <input type="text" id="create_username" name="create_username">
            <label for="create_email">Enter an Email</label>
            <input type="email" id="create_email" name="create_email">
            <label for="create_birthdate">Enter Birthday</label>
            <input type="date" id="create_birthday" name="create_birthday">
            <label for="create_password">Select a Password</label>
            <input type="password" id="create_password" name="create_password">
            <label for="create_validate_password">Confirm Password</label>
            <input type="password" id="create_validate_password" name="create_validate_password">
            <input type="submit" value="Create Account">
        </form>
    </div>
</div>


<?php include("includes/footer.php"); ?>