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
    Age: <input type="number" name="age"> <hr>

    Apples: <input type="checkbox" name="fruits[]" value="apples"> <br>
    Bananas: <input type="checkbox" name="fruits[]" value="bananas"> <br>
    Oranges: <input type="checkbox" name="fruits[]" value="oranges"> <hr>

    Student Name: <input type="text" name="studentName"> <hr>
    
    <input type="submit">
  </form>
  <hr>
  
  <br>
  Your name is <?php if (isset($_GET["name"])) echo $_GET["name"]; ?><br>
  Your age is <?php if (isset($_GET["age"])) echo $_GET["age"]; ?> <hr>

  Your fruits are: <br>
  <?php 
    if (isset($_GET["fruits"])) {
      $fruits = $_GET["fruits"];
      foreach ($fruits as $fruit) {
        echo $fruit . "<br>";
      }
    }
  ?> <hr>

  <?php 
  $grades = array("Adam"=>"A+", "Brock"=>"B-", "Charlie"=>"C+");
  echo $grades[$_GET["studentName"]];
  ?> <hr>
 
</body>
</html>