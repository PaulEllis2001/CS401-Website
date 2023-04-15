<?php
require_once '../database/Dao.php';
if(!isset($_COOKIES['PHPSESSID'])){
    session_start();
}

$dao= new Dao();

if(isset($_POST['search'])){
   $results = $dao->searchUsers();
   $response = array();
   foreach($results as $row){
      foreach($row as $column){
        if(str_contains($column, $_POST['search'])){
            array_push($response, $row);
            break;
        }
      }
   }
   $_SESSION['result_type'] = "users";
    $_SESSION['search_results'] = json_encode($response);
} else {
    $_SESSION['search_results'] = json_encode($_POST);
}

header("Location: ../searchResults.php", true, 302);
die();
