<?php
require_once '../database/Dao.php';


if(!isset($_POST[''])){
    echo print_r($_POST);
}

if(isset($_POST['num_coins'])){
    echo "Purchasing a number of coins";
} else {
    echo "Purchasing a value of coins";
}

if(isset($_POST['user_id'])){
    echo $_POST['user_id'];
} else {
   echo "NO USER ID FOUND";
}
if(isset($_POST['coin_id'])){
    echo $_POST['coin_id'];
} else {
   echo "NO COIN ID FOUND";
}

?>
