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

$result = $conn->query("SELECT id, name_item, price_item, stock_item FROM data_item");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/1f2a6d0a58.js" crossorigin="anonymous"></script>
  <title>Inventory Handler - Homepage</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin-top: 0;
      overflow-x: hidden;
      margin-left: 0;
      margin-right: 0;
    }

    h1 {
      background-color: DodgerBlue;
      border: none;
      color: white;
      padding: 12px;
      text-align: center;
      margin: 0;
      width: 100%;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      height: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    .buttoncontainer {
      display: flex;
      justify-content: flex-end;
    }

    .all_button {
      display: inline-flex;
      border: 1px solid #666699;
      border-radius: 4px;
      overflow: hidden;
      justify-content: flex-end;
    }

    .btnreset {
      background-color: #FF0033;
      border: none;
      color: white;
      padding: 10px 12px;
      font-size: 16px;
      cursor: pointer;
      border-right: 1px solid #666
    }

    .btnreset:hover {
      background-color: #CC0033;
    }

    .btnadd {
      background-color: #007bff;
      border: none;
      color: white;
      padding: 10px 12px;
      font-size: 16px;
      cursor: pointer;
    }

    .btnadd:hover {
      background-color: #0056b3;
    }

    .btndel {
      background-color: #FF9900;
      border-radius: 15px;
      border: none;
      color: black;
      padding: 8px 12px;
      font-size: 16px;
      cursor: pointer;
    }

    .btndel:hover {
      background-color: #CC9900;
    }

    .btnedit {
      background-color: #FFFF00;
      border-radius: 15px;
      border: none;
      color: black;
      padding: 8px 12px;
      font-size: 16px;
      cursor: pointer;
    }

    .btnedit:hover {
      background-color: #CCFF33;
    }

    .btnimport {
      padding: 10px 12px;
      font-size: 16px;
      outline: none;
      border: none;
      cursor: pointer;
      background: #339999;
      color: white;
      border-right: 1px solid #666
    }

    .btnimport:hover {
      background: rgb(1, 115, 115);
    }

    .btnexport {
      padding: 10px 12px;
      font-size: 16px;
      outline: none;
      border: none;
      cursor: pointer;
      background: rgb(87, 85, 88);
      color: white;
      border-right: 1px solid #666
    }

    .btnexport:hover {
      background: rgb(78, 74, 79);
    }
  </style>
</head>

<body>

  <h1>Item Inventory List</h1>
  <div class="buttoncontainer">
    <div class="all_button">
      <a href="import.php">
        <button class="btnimport"><i class="fa fa-rotate-left"></i> Import</button>
      </a>
      <a href="export.php">
        <button class="btnexport"><i class="fa fa-rotate-right"></i> Export</button>
      </a>
      <a href="reset.php">
        <button class="btnreset"><i class="fa fa-rotate-left"></i> Reset</button>
      </a>
      <a href="input.php">
        <button class="btnadd"><i class="fa fa-plus"></i> Add Item</button>
      </a>
    </div>
  </div>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Item Name</th>
        <th>Price per Item</th>
        <th>Inventory Stock</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
          <td>{$row['id']}</td>
          <td>{$row['name_item']}</td>
          <td>{$row['price_item']}</td>
          <td>{$row['stock_item']}</td>
          <td>
          <form method='POST' action='update.php' style='display:inline;'>
              <input type='hidden' name='id' value='{$row['id']}'>
              <button type='submit' class='btnedit'><i class='fa-solid fa-pen'></i></button>
            </form>
          <form method='POST' action='delete.php' style='display:inline;'>
              <input type='hidden' name='id' value='{$row['id']}'>
              <button type='submit' class='btndel'><i class='fa fa-trash'></i></button>
            </form>
            </td>
          </tr>";
        }
      }
      ?>
    </tbody>
  </table>



</body>

</html>