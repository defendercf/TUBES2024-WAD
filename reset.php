<?php
$host = 'mysql-1a6a1ab5-webtubes-2024.d.aivencloud.com';
$port = 24935;
$dbname = 'defaultdb';
$username = 'avnadmin';
$password = 'AVNS_1exSj5D6k4foMCFrrFW';

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM data_item";
$sql2 = "ALTER TABLE data_item AUTO_INCREMENT = 1";

if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error deleting records: " . $conn->error;
}
if ($conn->query($sql2) === TRUE) {
  header("Location: index.php");
  exit();
} else {
  echo "Error reseting increment " . $conn->error;
}

$conn->close();
?>