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

$updatename = $updateprice = $updatestock = "";
$id = null;

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $stmt = $conn->prepare("SELECT id, name_item, price_item, stock_item FROM data_item WHERE id = ?");
  $stmt->bind_param("i", $id);

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $updatename = $row["name_item"];
      $updateprice = $row["price_item"];
      $updatestock = $row["stock_item"];
    }
  }
  $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['nameInput']) && isset($_POST['priceInput']) && isset($_POST['stockInput']) && isset($_POST['id'])) {
    $name = $_POST['nameInput'];
    $price = $_POST['priceInput'];
    $stock = $_POST['stockInput'];
    $id = $_POST['id'];

    if (!empty($name) && !empty($price) && !empty($stock)) {
      $stmt = $conn->prepare("UPDATE data_item SET name_item = ?, price_item = ?, stock_item = ? WHERE id = ?");
      $stmt->bind_param("sdii", $name, $price, $stock, $id);

      if ($stmt->execute()) {
        header("Location: index.php");
        exit;
      } else {
        echo "Error: " . $stmt->error;
      }

      $stmt->close();
    }
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
  <title>Inventory Handler - Change Item</title>
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

  <h1>Update Data</h1>

  <form method="post" action="">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <input type="text" name="nameInput" value="<?php echo htmlspecialchars($updatename); ?>" required>
    <br>
    <input type="text" name="priceInput" value="<?php echo htmlspecialchars($updateprice); ?>" required>
    <br>
    <input type="text" name="stockInput" value="<?php echo htmlspecialchars($updatestock); ?>" required>
    <br>
    <button type="submit">Update</button>
  </form>

</body>

</html>