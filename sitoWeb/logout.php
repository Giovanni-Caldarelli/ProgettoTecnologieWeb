<?php
session_start();
session_destroy();
header('Location: homePage/homePage.php');
exit();
?>
