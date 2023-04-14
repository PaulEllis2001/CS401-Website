<?php include('includes/header.php');
require_once 'Widgets.php';
if(!isset($_COOKIES['PHPSESSID'])){
   session_start();
}

$widget = new Widgets();
?>
<h1>Search Results</h1>
<h2> Not yet Implemented </h2>
<?php
    if(isset($_SESSION['search_results'])){
        echo $_SESSION['search_results'];
        echo $widget->renderTable((array)json_decode($_SESSION['search_results']));        
   }

?>
<?php include('includes/footer.php');?>
