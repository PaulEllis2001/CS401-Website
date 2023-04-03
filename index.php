<?php include("includes/header.php");?>
<h1>Welcome! Please <a href="login.php">Login Or Create an Account</a></h1>
<div class="main_box">
    <div class="main_box_row">
        <div class="row_item" id="leaderboard_summary">
            <div class="lbs_item center_content" id="leaderboard_summary_gain">
                <h2>Top Gains</h2>
                <table>
                    <thead>
                        <th>User</th>
                        <th>% Gain</th>
                        <th>Portfolio Value</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>User1</td>
                            <td class="positive">+ 50.34 %</td>
                            <td>$ 300,231.56</td>
                        </tr>
                        <tr>
                            <td>User2</td>
                            <td class="positive">+ 49.67 %</td>
                            <td>$ 270,145.61</td>
                        </tr>
                        <tr>
                            <td>User3</td>
                            <td class="positive">+ 47.42 %</td>
                            <td>$ 280,123.70</td>
                        </tr>
                        <tr>
                            <td>User4</td>
                            <td class="positive">+ 45.45 %</td>
                            <td>$ 200,690.69</td>
                        </tr>
                    </tbody>
                </table>
                <p><a href="leaderboard.php">Click to see more</a></p>
            </div>
            <div class="lbs_item center_content" id="leaderboard_summary_loss">
                <h2>Top Losses</h2>
                <table>
                    <thead>
                        <th>User</th>
                        <th>% Loss</th>
                        <th>Portfolio Value</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>User1</td>
                            <td class="negative">+ 50.34 %</td>
                            <td>$ 300,231.56</td>
                        </tr>
                        <tr>
                            <td>User2</td>
                            <td class="negative">+ 49.67 %</td>
                            <td>$ 270,145.61</td>
                        </tr>
                        <tr>
                            <td>User3</td>
                            <td class="negative">+ 47.42 %</td>
                            <td>$ 280,123.70</td>
                        </tr>
                        <tr>
                            <td>User4</td>
                            <td class="negative">+ 45.45 %</td>
                            <td>$ 200,690.69</td>
                        </tr>
                    </tbody>
                </table>
                <p><a href="leaderboard.php">Click to see more</a></p>
            </div>
        </div>
        <div class="row_item" id="coin_summary">
            <div class="column_item center_content">
            <h2>Coin Summary</h2>
            <div>
            <table>
                <thead>
                    <th>Coin</th>
                    <th>% Gain</th>
                    <th>USD/Coin</th>
                </thead>
                <tbody>
                    <tr>
                        <td>SillyGooseCoin</td>
                        <td class="positive">+ 50.34 %</td>
                        <td>$ 1.23</td>
                    </tr>
                    <tr>
                        <td>KillMeNowCoin</td>
                        <td class="positive">+ 49.67 %</td>
                        <td>$ 1.11</td>
                    </tr>
                    <tr>
                        <td>RedHeringCoin</td>
                        <td class="positive">+ 47.42 %</td>
                        <td>$ 0.69</td>
                    </tr>
                    <tr>
                        <td>AdHocCoin</td>
                        <td class="positive">+ 45.45 %</td>
                        <td>$ 2.03</td>
                    </tr>
                </tbody>
            </table>
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
                    <div class="center_content left_item">
                        <h3>CASH</h3>
                        <h3 class="bordered">$ 83,000</h3>
                    </div>
                    <hr>
                    <div class="center_content">
                        <h3>COINS</h3>
                        <h3 class="bordered">$ 2,139.01</h3>
                    </div>
                    <hr>
                    <div class="center_content">
                        <h3>CHANGE</h3>
                        <h3 class="positive bordered">+ 3.01%</h3>
                    </div>
                </div>
                <hr>
                <div class="row_item" id="as_coins">
                    <div class="center_content">
                    <h3>Coins</h3>
                    <table>
                        <thead>
                            <th>Coin</th>
                            <th>USD Value</th>
                            <th>% Change</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SillyGooseCoin</td>
                                <td>$ 321.00</td>
                                <td class="positive">+ 13%</td>
                            </tr>
                            <tr>
                                <td>KillMeNowCoin</td>
                                <td>$ 41.03</td>
                                <td class="negative">- 2.31%</td>
                            </tr>
                            <tr>
                                <td>RedHeringCoin</td>
                                <td>$34.23</td>
                                <td class="positive">+ 3.4%</td>
                            </tr>
                            <tr>
                                <td>AdHocCoin</td>
                                <td>$ 23.45</td>
                                <td class="negative">- 0.69%</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
