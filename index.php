<?php include("includes/header.php");?>

<h1>Welcome!</h1>

<!--div>
    <div class="flex-row-box">
        <div id="leaderboardSummary" class="info_box">
            <div id="leaderboardSummaryHeaders">
                <div class="left_box">
                    <h2 class="boxHeading">Top Gain</h2>
                    <table>
                        <thead>
                            <th>
                                Column 1
                            </th>
                            <th>
                                Column 2
                            </th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hello</td>
                                <td>World</td>
                            </tr>
                            <tr>
                                <td>This is</td>
                                <td>Paul</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="right_box">
                    <h2 class="boxHeading">Top Loss</h2>
                    <table>
                        <thead>
                            <th>
                                Column 1
                            </th>
                            <th>
                                Column 2
                            </th>
                        </thead>
                        <tbody>
                            <tr> 
                                <td>Hello</td>
                                <td>World</td>
                            </tr>
                            <tr>
                                <td>This is</td>
                                <td>Paul</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="coinSummary" class="info_box">
            <h2 class="boxHeading">Top Coins Last 24 Hours</h2>
            <div class="box">
                <table>
                    <thead>
                        <th>
                            Column 1
                        </th>
                        <th>
                            Column 2
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hello</td>
                            <td>World</td>
                        </tr>
                        <tr>
                            <td>This is</td>
                            <td>Paul</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="accountSummary" class="info_box">

    </div>

</div-->
<div class="main_box">
    <div class="main_box_row">
        <div class="row_item" id="leaderboard_summary">
            <div class="lbs_item" id="leaderboard_summary_gain">
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
                <p>Click to see more</p>
            </div>
            <div class="lbs_item" id="leaderboard_summary_loss">
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
                <p>Click to see more</p>
            </div>
        </div>
        <div class="row_item" id="coin_summary">
            <div class="column_item">
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
            <p>Click to see more</p>
            </div>
        </div>
    </div>
    <div class="main_box_row">
        <div class="column_item" id="account_summary">
            <h2>Account Summary</h2>
            <div class="row_item">
                <div class="row_item" id="as_portfolio">
                    <div>
                        <h3>CASH</h3>
                        <h3>$ 83,000</h3>
                    </div>
                    <div>
                        <h3>COINS</h3>
                        <h3>$ 2,139.01</h3>
                    </div>
                    <div>
                        <h3>CHANGE</h3>
                        <h3 class="positive">+ 3.01%</h3>
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