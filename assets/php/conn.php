<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "softech";

//$server = "localhost:3306";
//$username = "cesenasc_user";
//$password = "aHx9Mz1XZoro";
//$db = "cesenasc_softech";

$conn = new mysqli($server, $username, $password, $db);

if ($conn->connect_error) {
  die("Connexión fallida: " . $conn->connect_error);
}