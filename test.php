<?php
require_once './database/Dao.php';
require_once 'Widgets.php';
$dao = new Dao();
$widget = new Widgets();
$result = $dao->debugTable();


//echo $widget->renderTable($passwords);

//$coins = $dao->debugTable("coin");
//echo "<pre>" . print_r($coins, 1) . "</pre>";

//$history = $dao->getCoinSummary();

//echo "<pre>" . print_r($history, 1) . "</pre>";

$result = $dao->updateRanks();
echo "<pre>" . print_r($result, 1) . "</pre>";



?>


<?php 



?>
