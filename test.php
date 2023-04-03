<?php
require_once './database/Dao.php';

$dao = new Dao();

$result = $dao->debugUsers();

print_r($result)
?>
