<?php include("includes/header.php");
require_once'Widgets.php';
require_once'database/Dao.php';

if(!isset($_COOKIE['PHPSESSID'])){
session_start();
}
if(!isset($_SESSION['user_id'])){
    header("Location: login.php", true, 302);
    die();
}
$dao = new Dao();
$user_id = $_SESSION['user_id'];
$userInfo = $dao->getUserInfo($_SESSION['user_id'])[0];
$userHistory = $dao->getUserHistory($_SESSION['user_id']);
$historyColumnNames = ["Coin Name", "Amount", "Value", "Gain/Loss", "Action"];
$userWallet = $dao->getUserWallet($_SESSION['user_id']);
$walletColumnNames = ["Coin Name", "Number of Coins", "Value of Coins"];
$widget = new Widgets();
$coinTotal = 0;

foreach($userWallet as $row){
    $coinTotal += $row['SUM(u.purchase_value)'];
}


?>

<div>
    <div class="column_box">
    <h1>Welcome Back <?php echo $userInfo['user_name'];?>!</h1>
        <div class="row">
            <div class="center_content account_row_item">
                <!-- PORTFOLIO OVERVIEW -->
                <h2>Portfolio Overview</h2>
                <p>
                <span>Current Cash: $ <?php echo$userInfo['user_cash'];?> </span></br>
                <span>Current Invested: $ <?php echo $coinTotal; ?> </span></br>
                    <span>24 Hour Change: <span class="positive">+ .03%</span> </span></br>
                    <span>Top Value Coin: <?php echo isset($userWallet[0])? isset($userWallet[0]['coin_name'])? $userWallet[0]['coin_name'] : 'No Coins in Wallet' : 'No Coins in Wallet';?></span> </br>
                    <span>Bottom Value Coin: <?php 
echo isset($userWallet[array_key_last($userWallet)]) ? $userWallet[array_key_last($userWallet)]['coin_name'] : 'No Coins in Wallet';?>  </span></br>
                    <span>Current Rank: #<?php echo $userInfo['user_rank'];?></span>
                </p>
            </div>
            <div class="center_content account_row_item">
                <!-- COINS IN WALLET  -->
                <h2>Coins In Wallet</h2>
                <?php echo $widget->renderCoinTable($userWallet, $walletColumnNames);?>
            </div>
        </div>
        <div class="center_content">
            <!-- HISTORY TABLE -->
            <h2>History</h2>
            <?php echo $widget->renderTable($userHistory, $historyColumnNames);?>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
