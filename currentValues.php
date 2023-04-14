<?php include("includes/header.php");
require_once'database/Dao.php';
require_once'Widgets.php';

$dao = new Dao();
$widget = new Widgets();

$values = $dao->getCurrentCoinValues();
$columnNames = ["Coin Name", "Coin Value", "Number in Circulation"];
?>

<div class="center_content">
    <h1>Current Values</h1>
    <div class="column_box">
        <div class="search">
            <form method="GET" action="handlers/values_search_handler.php">
                <input type="text" id="query">
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="center_content">
            <?php
                $extraHeading = array("Buy or Sell");
                $extraData = array_fill(0, count($values), array("<button class=\"buy\">Buy</button><button class=\"sell\">Sell</button>"));
                echo $widget->renderTableWithExtraColumns($values, $columnNames, $extraHeading, $extraData);
            ?>
        </div>
    </div>
</div>



<?php include("includes/footer.php"); ?>
