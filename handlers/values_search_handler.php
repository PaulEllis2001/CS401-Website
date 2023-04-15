<?php
require_once '../database/Dao.php';

if(!isset($_COOKIES['PHPSESSID'])){
   session_start();
}

$dao = new Dao();

if(isset($_POST['query'])){
   $results = $dao->searchCoins();
   $response = array();
   foreach($results as $row){
     //check if for each column in row the column contains the query.  
      foreach($row as $column){
        if(str_contains($column, $_POST['query'])){
           array_push($response, $row);
           break;
        }
      }
   }
   $_SESSION['result_type'] = "coins";
    $_SESSION['search_results'] = json_encode($response);
} else {
    $_SESSION['search_results'] = json_encode("no search results");
}
header("Location: ../searchResults.php", true, 302);
die();
