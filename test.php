<?php
require_once './database/Dao.php';
require_once 'Widgets.php';
$dao = new Dao();
$widget = new Widgets();
$result = $dao->debugTable();

echo "<pre>" . print_r($result, 1) . "</pre>";

//echo $widget->renderTable($passwords);

//$coins = $dao->debugTable("coin");
//echo "<pre>" . print_r($coins, 1) . "</pre>";

//$history = $dao->getCoinSummary();

//echo "<pre>" . print_r($history, 1) . "</pre>";

for( $i = 1; $i < 11; $i++){
   for( $j = 0; $j < 100; $j++){
        $percent_change = rand(0, 10);
        $dao->updateCoin($i, $percent_change);
   }
}


for( $i = 1; $i < 1002; $i++){
    $new_date = date("Y-m-d H:i:s", mt_rand(1650083453 ,1681619453));
    $dao->updateHistoryDate($i, $new_date);
    echo $new_date . "</br>";
}


?>


<?php 



?>
