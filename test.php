<?php
require_once './database/Dao.php';
require_once 'Widgets.php';
$dao = new Dao();
$widget = new Widgets();
$result = $dao->debugTable();

echo "<pre>" . print_r($result, 1) . "</pre>";
$passwords = $dao->getPasswords();

//echo $widget->renderTable($passwords);
foreach($passwords as $row){
   echo "<br/>" . $row['user_name'] . "   " . $row['user_id'] . "\t"  . hash("sha256", $row['user_password'])  ."\n";
}
echo hash("sha256", "Paul Ellis");

//$coins = $dao->debugTable("coin");
//echo "<pre>" . print_r($coins, 1) . "</pre>";

//$history = $dao->getCoinSummary();

//echo "<pre>" . print_r($history, 1) . "</pre>";

?>


<?php 



?>
