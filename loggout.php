<?php
session_start();
$username = session_destroy();
// session_destroy();
header("location: login.php");
?>