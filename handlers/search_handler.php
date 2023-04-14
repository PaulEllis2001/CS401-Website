<?php
require_once '../database/Dao.php';
if(!isset($_COOKIES['PHPSESSID'])){
    session_start();
}

$dao= new Dao();

if(isset($_POST['search'])){
    $_SESSION['search_results'] = json_encode("NOT YET IMPLEMENTED");
} else {
    $_SESSION['search_results'] = json_encode($_POST);
}

header("Location: ../searchResults.php", true, 302);
die();
