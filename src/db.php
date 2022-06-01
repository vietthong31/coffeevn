<?php
$servername = "localhost";
$username = "root";
$pwd = "";
$db = "quanlycafe";

$con = mysqli_connect($servername, $username, $pwd, $db);

if (!$con) {
  header("Location: error.php");
}
