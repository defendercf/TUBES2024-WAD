<?php
$host = 'mysql-1a6a1ab5-webtubes-2024.d.aivencloud.com';
$port = 24935;
$dbname = 'defaultdb';
$username = 'avnadmin';
$password = 'AVNS_1exSj5D6k4foMCFrrFW';

$conn = new mysqli($host, $username, $password, $dbname, $port);

header("Content-Type: application/octet-stream");
header("Content-Transfer-Encoding: Binary");
header('Content-Disposition: attachment; filename="export.csv"');

$stmt = $conn->prepare("SELECT * from data_item");
$stmt->execute();
$result = $stmt->get_result();
echo implode(";", [
  "ID",
  "Item Name",
  "Price per item",
  "Inventory Stock"
]);
echo "\r\n";
while ($row = $result->fetch_assoc()) {
  echo implode(";", [
    $row["id"],
    $row["name_item"],
    $row["price_item"],
    $row["stock_item"]
  ]);
  echo "\r\n";
}
?>