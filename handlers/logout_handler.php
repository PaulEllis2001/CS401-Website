<?php

session_destroy();

header("Location: ../login.php", true, 302);
die();

?>