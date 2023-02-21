<?php include("includes/header.php");?>

<div class="center_content">
    <h1>Leaderboard</h1>
    <div class="column_box">
        <div class="">
            <button onclick="window.location.href='?tab=user_gains';">User Gains</button>
            <button onclick="window.location.href='?tab=user_losses';">User Losses</button>
            <button onclick="window.location.href='?tab=coin_gains';">Coin Gains</button>
            <button onclick="window.location.href='?tab=coin_losses';">Coin Losses</button>
        </div>
        <div class="center_content">
            <table>
                <thead>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Portfolio Amount</th>
                    <th>Gain</th>
                    <th>Best Coin</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>CryptoBroMan</td>
                        <td>$ 1,420,690 </td>
                        <td class="positive">+ 450%</td>
                        <td>GainzCoin</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>CryptoBrotato</td>
                        <td>$ 1,321,642 </td>
                        <td class="positive">+ 432%</td>
                        <td>GainzCoin</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>DeusRexCrypto</td>
                        <td>$ 1,219,456 </td>
                        <td class="positive">+ 428%</td>
                        <td>GainzCoin</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>MenaceToSociety</td>
                        <td>$ 1,111,112 </td>
                        <td class="positive">+ 412%</td>
                        <td>LulzCoin</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>ParentsBasmentDweller21</td>
                        <td>$ 1,010,156 </td>
                        <td class="positive">+ 401%</td>
                        <td>GainzCoin</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>BugattiLvr69</td>
                        <td>$ 999,187 </td>
                        <td class="positive">+ 398%</td>
                        <td>CronieCoin</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>