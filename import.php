<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Handler - Upload File CSV</title>
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

    .boxc {
      border: 1px solid black;
      background-color: #dddddd;
      padding: 50px;
      border-radius: 10px;
    }

    form {
      padding-bottom: 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    label,
    input,
    button {
      margin-bottom: 10px;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <div class="boxc">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <label for="file">Choose CSV file:</label>
      <input type="file" name="file" id="file" accept=".csv" required>
      <button type="submit">Upload</button>
    </form>
  </div>
</body>

</html>