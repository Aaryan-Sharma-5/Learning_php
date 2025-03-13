<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<?php 
  function sayHi($name, $age) {
    echo "Hello $name, you are $age years old. <br>";
  }
  sayHi("Mike", 40);
  sayHi("Dave", 30);
  sayHi("Oscar", 50);
  sayHi("John", 20);
  sayHi("Jim", 60);

  echo "<hr>";

  function cube($num) {
    return $num * $num * $num;
  }
  echo cube(3) . " is the cube of 3 <br>";
  echo cube(4) . " is the cube of 4 <br>";
  echo cube(5) . " is the cube of 5 <br>";

  echo "<hr>";

  function maxNum($num1, $num2, $num3) {
    if ($num1 >= $num2 && $num1 >= $num3) {
      return $num1;
    } elseif ($num2 >= $num1 && $num2 >= $num3) {
      return $num2;
    } else {
      return $num3;
    }
  }
  echo maxNum(300, 400, 500) . " is the largest number <br>";

  echo "<hr>";
?>

</body>
</html>