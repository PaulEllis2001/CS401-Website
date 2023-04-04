<?php include("includes/header.php");

require_once'database/Dao.php';
if(!isset($_COOKIE['PHPSESSID'])){
session_start();
}
if(!isset($_SESSION['user_id'])){
    header("Location: login.php", true, 302);
    die();
}
$dao = new Dao();
$userInfo = $dao->getUserInfo($_SESSION['user_id'])[0];
$userHistory = $dao->getUserHistory($_SESSION['user_id']);
$userWallet = $dao->getUserWallet($_SESSION['user_id']);

?>

<div>
    <div class="column_box">
    <h1>Welcome Back <?php echo $userInfo['user_name'];?>!</h1>
        <div class="row">
            <div class="center_content account_row_item">
                <!-- PORTFOLIO OVERVIEW -->
                <h2>Portfolio Overview</h2>
                <p>
                    <span>Current Cash: $ 32,100 </span></br>
                    <span>Current Invested: $ 2,950.10 </span></br>
                    <span>24 Hour Change: <span class="positive">+ .03%</span> </span></br>
                    <span>Top Value Coin: Coiny Coin</span> </br>
                    <span>Bottom Value Coin: AlphaBravo Coin </span></br>
                    <span>Current Rank: #321</span>
                </p>
            </div>
            <div class="center_content account_row_item">
                <!-- COINS IN WALLET  -->
                <h2>Coins In Wallet</h2>
                <table>
                    <thead>
                        <th>Name</th>
                        <th>Ammount</th>
                        <th>Value</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="coin.php">CoinyCoin</a></td>
                            <td>121</td>
                            <td>$ 1,234.56</td>
                        </tr>
                        <tr>
                            <td><a href="coin.php">CoinyCoin</a></td>
                            <td>121</td>
                            <td>$ 1,234.56</td>
                        </tr>
                        <tr>
                            <td><a href="coin.php">CoinyCoin</a></td>
                            <td>121</td>
                            <td>$ 1,234.56</td>
                        </tr>
                        <tr>
                            <td><a href="coin.php">CoinyCoin</a></td>
                            <td>121</td>
                            <td>$ 1,234.56</td>
                        </tr>
                        <tr>
                            <td><a href="coin.php">CoinyCoin</a></td>
                            <td>121</td>
                            <td>$ 1,234.56</td>
                        </tr>
                        <tr>
                            <td><a href="coin.php">CoinyCoin</a></td>
                            <td>121</td>
                            <td>$ 1,234.56</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <!-- HISTORY TABLE -->
            <h2>History</h2>
            <table>
                <thead>
                    <th>Coin</th>
                    <th>Ammount</th>
                    <th>Value</th>
                    <th>Gain/Loss</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td>AlphaBravo Coin</td>
                        <td>200</td>
                        <td>$30.10</td>
                        <td class="negative">-$19.90</td>
                        <td>Sell</td>
                    </tr>
                    <tr>
                        <td>Coiny Coin</td>
                        <td>121</td>
                        <td>$ 1,234.56</td>
                        <td>-----</td>
                        <td>Buy</td>
                    </tr>
                    <tr>
                        <td>AlphaBravo Coin</td>
                        <td>200</td>
                        <td>$30.10</td>
                        <td class="negative">-$19.90</td>
                        <td>Sell</td>
                    </tr>
                    <tr>
                        <td>Coiny Coin</td>
                        <td>121</td>
                        <td>$ 1,234.56</td>
                        <td>-----</td>
                        <td>Buy</td>
                    </tr>
                    <tr>
                        <td>AlphaBravo Coin</td>
                        <td>200</td>
                        <td>$30.10</td>
                        <td class="negative">-$19.90</td>
                        <td>Sell</td>
                    </tr>
                    <tr>
                        <td>Coiny Coin</td>
                        <td>121</td>
                        <td>$ 1,234.56</td>
                        <td>-----</td>
                        <td>Buy</td>
                    </tr>
                    <tr>
                        <td>AlphaBravo Coin</td>
                        <td>200</td>
                        <td>$30.10</td>
                        <td class="negative">-$19.90</td>
                        <td>Sell</td>
                    </tr>
                    <tr>
                        <td>Coiny Coin</td>
                        <td>121</td>
                        <td>$ 1,234.56</td>
                        <td>-----</td>
                        <td>Buy</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
