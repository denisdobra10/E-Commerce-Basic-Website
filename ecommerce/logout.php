<?php
include "config.php";
session_start();

$goodByeMessage = "See you soon, {$_SESSION['userInfo'][1]}!";
unset($_SESSION['userInfo']);
unset($_SESSION['cart']);

GoToLocation("index.php", $goodByeMessage, 0);
?>