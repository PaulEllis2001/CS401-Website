<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Fraud Coin</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="images/whiteIcon.png" rel="icon">
        <script src="js/jquery-3.6.4.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery.canvasjs.min.js"></script>
        <script src="js/graph.js"></script>
        <script src="js/cookies.js"></script>
    </head>
    <body>
    <?php
        $currentPage = $_SERVER['REQUEST_URI'];
        if($currentPage == "/"){
            $currentPage = "/index.php";
        }
    ?>
        <nav class="navbar">
            <div class="container">
                <div class="navbar">
                <img src="../images/whiteIcon.png" class="title-icon"/>
                <h1 class="heading"><a class="title-nav" href="index.php">FraudCoin</a></h1>
                <form class="search_form" id="search_form" method="POST" action="handlers/search_handler.php">
                    <input type="text" id="search" name="search" placeholder="Search">
                    <input type="submit" value="Search">
                </form>
                    <ul class="navbar-nav">
                    <li class="<?php echo $currentPage == "/index.php" ? "current-page" : ""?> nav-item ">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="<?php echo $currentPage == "/leaderboard.php" ? "current-page" : ""?> nav-item">
                            <a class="nav-link" href="leaderboard.php">Leaderboard</a>
                        </li>
                        <li class="<?php echo $currentPage == "/currentValues.php" ? "current-page" : ""?> nav-item ">
                            <a class="nav-link" href="currentValues.php">Current Values</a>
                        </li>
                        <li class="<?php echo $currentPage == "/account.php" ? "current-page" : ""?> nav-item ">
                            <a class="nav-link" href="account.php">Account Overview</a>
                        </li>
                        <li class="<?php echo $currentPage == "/login.php" ? "current-page" : ""?> nav-item ">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="<?php echo $currentPage == "/logout.php" ? "current-page" : ""?> nav-item ">
                            <a class="nav-link" href="handlers/logout_handler.php"> Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container">
