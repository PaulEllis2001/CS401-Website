<?php include("includes/header.php");
require_once'database/Dao.php';
require_once'Widgets.php';

$dao = new Dao();
$widget = new Widgets();



?>

<div class="center_content">
    <h1>Current Values</h1>
    <div class="column_box">
        <div class="search">
            <form method="GET" action="handlers/values_search_handler.php">
                <input type="text" id="search_querry">
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="center_content">
            <table>
                <thead>
                    <th>Coin Name</th>
                    <th>USD Per Coin</th>
                    <th>24 Hour Change</th>
                    <th>Buy/Sell</th>
                </thead>
                <tbody>
                    <tr>
                        <td>AlphaBravoCoin</td>
                        <td>$ 0.023</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button onclick="window.location.href='?coin=AlphaBravoCoin&action=buy';">Buy</button><button onclick="window.location.href='?coin=AlphaBravoCoin&action=sell';">Sell</button></td>
                    </tr>
                    <tr>
                        <td>CoinyCoin</td>
                        <td>$ 0.001</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button onclick="window.location.href='?coin=CoinyCoin&action=buy';">Buy</button><button onclick="window.location.href='?coin=CoinyCoin&action=sell';">Sell</button></td>
                    </tr>
                    <tr>
                        <td>SillyGooseCoin</td>
                        <td>$ 0.012</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button onclick="window.location.href='?coin=SillyGooseCoin&action=buy';">Buy</button><button onclick="window.location.href='?coin=SillyGooseCoin&action=sell';">Sell</button></td>
                    </tr>
                    <tr>
                        <td>KillMeNowCoin</td>
                        <td>$ 0.03</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button onclick="window.location.href='?coin=KillMeNowCoin&action=buy';">Buy</button><button onclick="window.location.href='?coin=KillMeNowCoin&action=sell';">Sell</button></td>
                    </tr>
                    <tr>
                        <td>RedHerringCoin</td>
                        <td>$ 0.32</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button onclick="window.location.href='?coin=RedHerringCoin&action=buy';">Buy</button><button onclick="window.location.href='?coin=RedHerringCoin&action=sell';">Sell</button></td>
                    </tr>
                    <tr>
                        <td>AdHocCoin</td>
                        <td>$ 0.00231</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button onclick="window.location.href='?coin=AdHocCoin&action=buy';">Buy</button><button onclick="window.location.href='?coin=AdHocCoin&action=sell';">Sell</button></td>
                    </tr>
                    <tr>
                        <td>GainzCoin</td>
                        <td>$ 0.521</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button onclick="window.location.href='?coin=GainzCoin&action=buy';">Buy</button><button onclick="window.location.href='?coin=GainzCoin&action=sell';">Sell</button></td>
                    </tr>
                    <tr>
                        <td>LulzCoin</td>
                        <td>$ 0.123</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button onclick="window.location.href='?coin=LulzCoin&action=buy';">Buy</button><button onclick="window.location.href='?coin=LulzCoin&action=sell';">Sell</button></td>
                    </tr>
                    <tr>
                        <td>CronieCoin</td>
                        <td>$ 0.451</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button onclick="window.location.href='?coin=CronieCoin&action=buy';">Buy</button><button onclick="window.location.href='?coin=CronieCoin&action=sell';">Sell</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include("includes/footer.php"); ?>
