<?php include("includes/header.php");?>

<div>
    <div class="row">
        <div class="row_item bordered">
            <div class="column_item center_content">
                <h2>CoinyCoin</h2>
                <p>
                    $0.003 per Coin </br>
                    + 3% 24 Hour Change </br>
                    41.73M in Circulation </br>
                </p>
            </div>
        </div>
        <div class="row_item bordered">
            <h2>History</h2>
            <button>24 Hr</button>
            <button>1 Wk</button>
            <img id="coin_graph" src="https://datavizproject.com/wp-content/uploads/types/Line-Graph.png">
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
                    <span class="owned_coin">$ 0.00</span>
                    <span class="owned_coin">0 Coin</span>
                </p>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>