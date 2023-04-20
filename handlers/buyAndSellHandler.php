<?php
require_once '../database/Dao.php';

$num_coins = null;
$val_coins = null;

if(!isset($_POST[''])){
    echo "<pre>" . print_r($_POST, 1) . "</pre>";
}

if(isset($_POST['num_coins'])? $_POST['num_coins'] != null ? true: false: false){
   $num_coins = $_POST['num_coins'];
    echo "Purchasing a number of coins</br>";
} else if (isset($_POST['value_coins'])? $_POST['value_coins'] != null ? true: false: false){
   $val_coins = $_POST['value_coins'];
    echo "Purchasing a value of coins</br>";
} else {
    echo "Error with purchasing amount</br>";
}

if(isset($_POST['user_id'])){
    echo $_POST['user_id'] . "</br>";
} else {
   echo "NO USER ID FOUND</br>";
}
if(isset($_POST['coin_id'])){
    echo $_POST['coin_id']. "</br>";
} else {
   echo "NO COIN ID FOUND</br>";
}

$dao = new Dao();

$coin_id = $_POST['coin_id'];
$user_id = $_POST['user_id'];
$action = $_POST['action'];

$coin_info = $dao->getCoinInfo($coin_id);

echo "<pre>" . print_r($coin_info, 1) . "</pre>";

if($num_coins != null){
   //FIND $val_coins
   //multiply num_coins by coin_value to get val_coin
   $val_coins = $num_coins * $coin_info[0]['coin_value'];
} else {
   //FIND $num_coins
   //divide val_coins by coin_value to get num_coins
   $num_coins = $val_coins / $coin_info[0]['coin_value'];
}

echo "$num_coins  $val_coins</br>";

if($action == 'sell'){
    $dao->createSaleOrder($user_id, $coin_id, $num_coins, $val_coins);
} else {
    $dao->createPurchaseOrder($user_id, $coin_id, $num_coins, $val_coins);
}


?>
