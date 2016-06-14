<?php
session_start();
$_SESSION['logged'] = false;
$_SESSION['user_id'] = -1;
header('Location: stanowisko.php');
?>