<?php
include 'includes/header.php';
require_once 'database/Dao.php';

if(!isset($_COOKIE['PHPSESSID'])){
session_start();
}
if(!isset($_SESSION['user_id'])){
    header("Location: login.php", true, 302);
    die();
}
$dao = new Dao();
$userInfo = $dao->getUserInfo($_SESSION['user_id'])[0];

$action = $_GET['action'];
$coin_name = null;


if(strcmp(substr($action, 0, 3), "buy") == 0){
   $coin_name = substr($action, 3, strlen($action));
   $action = substr($action, 0, 3);
} else {
   $coin_name = substr($action, 4, strlen($action));
   $action = substr($action, 0, 4);
}

$coin_info = $dao->getCoinInfo($dao->getCoinID($coin_name)[0]['coin_id']);
$user_coin_info = $dao->getUserCoinSpecific($userInfo['user_id'], $coin_info[0]['coin_id']);

?>


<div class="container">
    <h1 class="center"> <?php echo $coin_info[0]['coin_name']; ?> </h1>
    <div>
        <h2> Value Per Coin: $<?php echo $coin_info[0]['coin_value']; ?> </h2>
        <h2> Current Value in Wallet: <?php echo $user_coin_info[0]['SUM(purchase_value)'] == null ? 0 : $user_coin_info[0]['SUM(purchase_value)']  ?></h2>
        <h2> Current Number in Wallet: <?php echo $user_coin_info[0]['SUM(purchase_amount)'] == null ? 0 : $user_coin_info[0]['SUM(purchase_amount)']  ?></h2>

        <form id="buyAndSell" method="POST" action="handlers/buyAndSellHandler.php">
            <label for="num_coins"><?php echo "Number of Coins to " . $action ?></label>
            <input type="number" id="num_coins" name="num_coins">
            <br/>
            <label for="value_coins"><?php echo "Number of Coins to " . $action ?></label>
            <input type="number" id="value_coins" name="value_coins">
            <br/>
            <input type="submit" value=<?php echo "\"$action\"";?>>
            <input type="hidden" value=<?php echo "\"{$userInfo['user_id']}\""?> name="user_id">
            <input type="hidden" value=<?php echo "\"{$coin_info[0]['coin_id']}\""?> name="coin_id">
            <input type="hidden" value=<?php echo "\"$action\""; ?> name="action">
        </form>
    </div>
</div>
