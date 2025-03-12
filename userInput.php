<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <form action="userInput.php" method="get">
    Name: <input type="text" name="name"> <br>
    Age: <input type="number" name="age"> <br>
    <input type="submit">
  </form>
  <br>
  Your name is <?php if (isset($_GET["name"])) echo $_GET["name"]; ?><br>
  Your age is <?php if (isset($_GET["age"])) echo $_GET["age"]; ?>
 
</body>
</html>