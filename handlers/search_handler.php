<?php

if(isset($_GET['query'])){

} else {
    $_SESSION['search_results'] = json_encode("no search results");
}

header("Location: ../searchResults.php", true, 302);
die();
