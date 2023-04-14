<?php include('includes/header.php');?>

<h1>Search Results</h1>
<h2> Not yet Implemented </h2>
<?php
    if(isset($_SESSION['search_results'])){
        echo $_SESSION['search_results'];
    }

?>
<?php include('includes/footer.php');?>
