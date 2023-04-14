<?php include("includes/header.php");
require_once'database/Dao.php';
require_once'Widgets.php';

$dao = new Dao();
$widget = new Widgets();
$userInfo = null;
$welcome = "Welcome";
if(isset($_SESSION['user_id'])){
   $userInfo = $dao->getUserInfo($_SESSION['user_id'])[0];
   $welcome .= " back, " . $userInfo['user_name'] . "!";
} else {
    $welcome.="! Please <a href=\"login.php\">Login or Create an Account</a>";
}

$gainColumnHeadings = ["Rank", "User", "Portfolio Value", "Best Coin"];
$LossColumnHeadings = ["Rank", "User", "Portfolio Value", "Best Coin"];



?>
   <h1><?php echo $welcome; ?></h1>
<div class="main_box">
    <div class="main_box_row">
        <div class="row_item" id="leaderboard_summary">
            <div class="lbs_item center_content" id="leaderboard_summary_gain">
                <h2>Top Gains</h2>
                <?php
                    $userGainLeaderboard = $dao->getUserLeaderboard();
                    $userLossesLeaderboard = $dao->getUserLeaderboard(true);
                    $userGainLeaderboard = array_slice($userGainLeaderboard, 0, 5, true);
                    $userLossesLeaderboard = array_slice($userLossesLeaderboard, 0, 5, true);
                    echo $widget->renderTable($userGainLeaderboard, $gainColumnHeadings);
                ?>
                <p><a href="leaderboard.php">Click to see more</a></p>
            </div>
            <div class="lbs_item center_content" id="leaderboard_summary_loss">
                <h2>Top Losses</h2>
                <?php 
                    echo $widget->renderTable($userLossesLeaderboard, $LossColumnHeadings);
                ?>
                <p><a href="leaderboard.php">Click to see more</a></p>
            </div>
        </div>
        <div class="row_item" id="coin_summary">
            <div class="column_item center_content">
            <h2>Coin Summary</h2>
            <div>
            <?php

                $coinSummary = array_slice($dao->getCurrentCoinValues(), 0, 5, true);
                    $coinHeadings = ["Coin Name","USD/Coin","Number in Circulation"];
                echo $widget->renderTable($coinSummary, $coinHeadings);

            ?>
            </div>
            <p><a href="currentValues.php">Click to see more</a></p>
            </div>
        </div>
    </div>
    <div class="main_box_row">
        <div class="column_item" id="account_summary">
            <div class="row">
                <h2>Account Summary</h2>
                <p><a href="account.php">Click to view full account details</a></p>
            </div>
            <div class="row_item">
                <div class="row_item" id="as_portfolio">
<?php 
                    if(!isset($_SESSION['user_id'])){
                       echo "<h2> Please <a href=\"login.php\">Login</a> to see a Summary </h2></div>";
                    } else {
                      echo accountSummary($userInfo, $dao, $widget); 
                    }


?>
            </div>
        </div>
    </div>
</div>
<?php

function accountSummary($userInfo, $dao, $widget){
   $columnNames= ["Coin Name","Coin Value","Total Value"];
    $html = "";
    $html .= "<div class=\"center_content left_item\"><h3>CASH</h3><h3 class=\"bordered\">$ " . $userInfo['user_cash'] . "</h3></div><hr>";
    $html .= "<div class=\"center_content\"><h3>COINS</h3><h3 class=\"bordered\">$ " . getCoinsValue($dao) . "</h3></div><hr>";
    $html .= "<div class=\"center_content\"><h3>TOTAL</h3><h3 class=\"bordered\">$ " . getCoinsValue($dao)+$userInfo['user_cash'] . "</h3></div><hr></div>";
    $html .= "<div class=\"row_item\" id=\"as_coins\"> <div class=\"center_content\"><h3>Coins</h3>" . $widget->renderTable($dao->getUserWallet($_SESSION['user_id']), $columnNames) . "</div></div>";

    return $html;
}
function getCoinsValue($dao){
    $coins = $dao->getUserWallet($_SESSION['user_id']);
    $sum = 0;
    foreach($coins as $row){
       $sum += $row['SUM(u.purchase_value)'];
    }
    return $sum;
}
?>
<?php include("includes/footer.php"); ?>
