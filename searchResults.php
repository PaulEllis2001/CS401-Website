<?php include('includes/header.php');
require_once 'Widgets.php';
if(!isset($_COOKIES['PHPSESSID'])){
   session_start();
}

$widget = new Widgets();
?>
<div class="center_content"><h1>Search Results</h1></div>
<div class="center_content">
<?php
    if(isset($_SESSION['search_results'])){
        $columnNames = ["Coin Name"," Coin Value","Number in Circulation"];
        if( isset($_SESSION['result_type']) ? $_SESSION['result_type'] == "users" : false){
           $columnNames = ["User Name", "User Rank", "User Cash"];
            echo $widget->renderTable(json_decode($_SESSION['search_results'], true), $columnNames);
        } else {
            echo $widget->renderCoinTable(json_decode($_SESSION['search_results'], true), $columnNames); 
        }
   }

?>
</div>
<?php include('includes/footer.php');?>
