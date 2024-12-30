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

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $stmt = $conn->prepare("DELETE FROM data_item WHERE id = ?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    header("Location: index.php");
  } else {
    echo "Error deleting record: " . $conn->error;
  }

  $stmt->close();
}

$conn->close();
?>