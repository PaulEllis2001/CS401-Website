<?php
require_once './database/Dao.php';

$dao = new Dao();

$result = $dao->debugTable();

echo "<pre>" . print_r($result, 1) . "</pre>";

$coins = $dao->debugTable("coin");
echo "<pre>" . print_r($coins, 1) . "</pre>";

$history = $dao->getCoinSummary();

echo "<pre>" . print_r($history, 1) . "</pre>";

?>


<?php 



?>
