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

if ($conn->query($sql) !== TRUE) {
  echo "Error deleting records: " . $conn->error;
}
if ($conn->query($sql2) === !TRUE) {
  echo "Error reseting increment " . $conn->error;
}
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
  $uploadDir = 'uploads/';
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }
  $uploadFile = $uploadDir . basename($_FILES['file']['name']);

  if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
    if (($file = fopen($uploadFile, "r")) !== false) {
      fgetcsv($file, 0, ";", '"', "\\");

      $stmt = $conn->prepare("INSERT INTO data_item (id, name_item, price_item, stock_item) VALUES (?, ?, ?, ?)");

      while (($data = fgetcsv($file, 0, ";", '"', "\\")) !== false) {
        if (count($data) >= 4) {
          $stmt->bind_param("isdi", $data[0], $data[1], $data[2], $data[3]);
          if (!$stmt->execute()) {
            echo "Error: " . $stmt->error . "<br>";
          }
        } else {
          echo "Incomplete data in row, skipping.<br>";
        }
      }

      fclose($file);
      $stmt->close();
    }
  } else {
    echo "Failed to move uploaded file.<br>";
  }
}

$conn->close();
header("Location: index.php");
exit();

?>