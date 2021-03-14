<?php

include("permissions.php");
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
  or die ('Could not connect to the database server' . mysqli_connect_error());
session_start();

$_SESSION['currentDate'] = mysqli_real_escape_string($con,$_POST["currentDate"]);
header("Location: chainThreeHotelsTest.php");
?>