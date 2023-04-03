<?php
require_once '../database/Dao.php';

$dao = new Dao();

$result = $dao->getLoginInformation("pdellis");

print_r($result)
?>