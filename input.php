<?php
// Database credentials
$host = 'mysql-1a6a1ab5-webtubes-2024.d.aivencloud.com';
$port = 24935;
$dbname = 'defaultdb';
$username = 'avnadmin';
$password = 'AVNS_1exSj5D6k4foMCFrrFW';

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['nameInput'];
  $price = $_POST['priceInput'];
  $stock = $_POST['stockInput'];

  if (!empty($name) && !empty($price) && !empty($stock)) {
    $stmt = $conn->prepare("INSERT INTO data_item (name_item, price_item, stock_item) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $name, $price, $stock);

    if ($stmt->execute()) {
      header("Location: index.php");
      exit;
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Inventory Handler - Add Item</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f9f9f9;
    }

    h1 {
      margin-bottom: 20px;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>

  <h1>Add Data</h1>

  <form method="post" action="">
    <input type="text" name="nameInput" placeholder="Enter item name" required>
    <br>
    <input type="text" name="priceInput" placeholder="Enter price" required>
    <br>
    <input type="text" name="stockInput" placeholder="Enter stock" required>
    <br>
    <button type="submit">Add</button>
  </form>

</body>

</html>