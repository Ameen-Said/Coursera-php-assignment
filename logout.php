<?php

session_start();

session_destroy();

header("Location: autoscrud.php");
return;
?>
