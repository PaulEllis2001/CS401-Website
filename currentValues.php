<?php include("includes/header.php");?>

<div>
    <h1>Current Values</h1>
    <div>
        <div class="search">
            <form method="GET" action="handlers/values_search_handler.php">
                <input type="text">
                <input type="submit">
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
                        <td><button>Buy</button><button>Sell</button></td>
                    </tr>
                    <tr>
                        <td>CoinyCoin</td>
                        <td>$ 0.001</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button>Buy</button><button>Sell</button></td>
                    </tr>
                    <tr>
                        <td>SillyGooseCoin</td>
                        <td>$ 0.012</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button>Buy</button><button>Sell</button></td>
                    </tr>
                    <tr>
                        <td>KillMeNowCoin</td>
                        <td>$ 0.03</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button>Buy</button><button>Sell</button></td>
                    </tr>
                    <tr>
                        <td>RedHerringCoin</td>
                        <td>$ 0.32</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button>Buy</button><button>Sell</button></td>
                    </tr>
                    <tr>
                        <td>AdHocCoin</td>
                        <td>$ 0.00231</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button>Buy</button><button>Sell</button></td>
                    </tr>
                    <tr>
                        <td>GainzCoin</td>
                        <td>$ 0.521</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button>Buy</button><button>Sell</button></td>
                    </tr>
                    <tr>
                        <td>LulzCoin</td>
                        <td>$ 0.123</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button>Buy</button><button>Sell</button></td>
                    </tr>
                    <tr>
                        <td>CronieCoin</td>
                        <td>$ 0.451</td>
                        <td class="positive">+ 13.30%</td>
                        <td><button>Buy</button><button>Sell</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include("includes/footer.php"); ?>