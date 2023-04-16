<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Fraud Coin</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="images/icon.png" rel="icon">
        <script src="js/jquery-3.6.4.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/jquery.canvasjs.min.js"></script>
        <script src="js/graph.js"></script>
        <script src="js/cookies.js"></script>
    </head>
    <body>
        <nav class="navbar">
            <div class="container">
                <div class="navbar">
                <h1 class="heading"><a class="title-nav" href="index.php">FraudCoin</a></h1>
                <form class="search_form" id="search_form" method="POST" action="handlers/search_handler.php">
                    <input type="text" id="search" name="search" placeholder="Search">
                    <input type="submit" value="Search">
                </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="leaderboard.php">Leaderboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="currentValues.php">Current Values</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="account.php">Account Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="handlers/logout_handler.php"> Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container">
