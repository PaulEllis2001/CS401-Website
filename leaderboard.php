<?php include("includes/header.php");
require_once'database/Dao.php';
require_once'Widgets.php';

$dao = new Dao();
$widget = new Widgets();

$leaderboard = null;
$columnNames = null;

if(isset($_GET['tab'])){
    if($_GET['tab'] == 'user_gains'){
        $leaderboard = $dao->getUserLeaderboard();
        $columnNames = ["User Rank","User Name","Portfolio Amount","Best Coin"];
    }
    else if( $_GET['tab'] == 'user_losses'){
        $leaderboard = $dao->getUserLeaderboard(true);
        $columnNames = ["User Rank","User Name","Portfolio Amount","Best Coin"];
    }
    else if( $_GET['tab'] == 'coin_gains'){
        $leaderboard = $dao->getCoinLeaderboard();
        $columnNames = ["Coin Name","Coin Value","Number in Circulation"];
    }
    else if ($_GET['tab'] == 'coin_losses'){
        $leaderboard = $dao->getCoinLeaderboard(true);
        $columnNames = ["Coin Name","Coin Value","Number in Circulation"];
    }
} else {
   $_GET['tab'] = "user_gains";
     $leaderboard = $dao->getUserLeaderboard();
        $columnNames = ["User Rank","User Name","Portfolio Amount","Best Coin"];
}
?>

<div class="center_content">
    <h1>Leaderboard</h1>
    <div class="column_box">
        <div class="nav_tab">
            <button onclick="window.location.href='?tab=user_gains';">User Gains</button>
            <button onclick="window.location.href='?tab=user_losses';">User Losses</button>
            <button onclick="window.location.href='?tab=coin_gains';">Coin Value</button>
            <button onclick="window.location.href='?tab=coin_losses';">Coin Value</button>
        </div>
        <div class="center_content">
        <?php
            if($_GET["tab"] == 'user_gains' || $_GET["tab"] == "user_losses"){
                echo $widget->renderTable($leaderboard, $columnNames); 
            } else {


                echo $widget->renderCoinTable($leaderboard, $columnNames);
            }
        ?>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
