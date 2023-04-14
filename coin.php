<?php include("includes/header.php");
require_once 'Widgets.php';
require_once 'database/Dao.php';

$dao = new Dao();
$coinID = $dao->getCoinID($_GET['coin_name'])[0]['coin_id'];
$coinInfo = $dao->getCoinInfo($coinID);

$coinHistory = $dao->getCoinHistory($coinID);
$fileName = "files/" . $_GET['coin_name'] . "_history.json";
file_put_contents($fileName, json_encode($coinHistory));

$userInfo = null;

if(isset($_SESSION['user_id'])){
   $userInfo = $dao->getUserCoinSpecific($_SESSION['user_id'], $coinID);
}

?>

<div>
    <div class="row">
        <div class="row_item bordered">
            <div class="column_item center_content">
                <h2><?php echo $_GET['coin_name']?></h2>
                <p>
                    <?php
                        echo "$ " . $coinInfo[0]['coin_value'] . " Per Coin<br/>";
                        echo "<span class=\"positive\"> + 000 % </span>24 Hour Change </br>";
                        echo $coinInfo[0]['coin_num_circulating'] . " In Circulation </br>";

                    ?>
                </p>
            </div>
        </div>
        <div class="row_item bordered">
            <h2>History</h2>
            <button>24 Hr</button>
            <button>1 Wk</button>
            <div id="chartContainer"></div>
        </div>
    </div>
    <div class="bordered">
        <div>
            <h2>Buy or Sell</h2>
        </div>
        <div class="row">
            <div class="column_item center_content">
                <form>
                    <label for="usd_amt">Enter ammount in USD</label>
                    <input type="text" id="usd_amt" placeholder="USD">
                    <br>
                    <label for="coin_amt">OR<br>Enter Number of Coins</label>
                    <input type="text" id="coin_amt" placeholder="Coins">
                    <br>
                    <input type="button" name="buy" value="Buy">
                    <input type="button" name="sell" value="Sell">
                </form>
            </div>
            <div class="row_item">
                <h3>Currently Own</h3>
                <p>
                    <?php
                        if($userInfo == null){
                            echo "Please <a href\"login.php\">Login</a> to buy or sell coins";
                        } else {
                            echo "<span class=\"owned_coin\">$ " . $userInfo[0]['SUM(purchase_value)'] . "</span>";
                            echo "<span class=\"owned_coin\"> " . $userInfo[0]['SUM(purchase_amount)'] . " Coin Owned</span>";
                        }

                    ?>
                </p>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
