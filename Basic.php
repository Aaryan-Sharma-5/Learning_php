<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  // Initial
  echo "<h1>Hello World</h1>";
  echo "<p>PHP is so fun!</p>";
  echo "<hr>";

  // Variable
  $name = "Aaryan";
  $age = 20;
  echo "My name is $name and I am $age years old <br>";
  echo "<hr>";

  // Data Types
  $string = "Hello World";
  $integer = 20;
  $float = 20.5;
  $boolean = true;
  $array = array("Aaryan", "20", "India");
  echo "String: $string <br>";
  echo "Integer: $integer <br>";
  echo "Float: $float <br>";
  echo "Boolean: $boolean <br>";
  echo "Array: $array[0], $array[1], $array[2] <br>";
  echo "<hr>";

  //String
  $string1 = "Hello";
  $string2 = "World";
  echo strtolower($string1) . " " . strtoupper($string2) . "<br>";
  echo strlen($string1) . "<br>";
  echo $string1[0] . " " . $string2[1] . "<br>";
  echo str_word_count($string1) . "<br>";
  echo strpos($string1, "l") . "<br>";
  echo strrev($string1) . "<br>";
  echo str_replace("Hello", "Hi", $string1) . "<br>";
  echo "<hr>";

  //Numbers  
  echo 5 + 5 . "<br>";
  echo 5 - 5 . "<br>";
  echo 5 * 5 . "<br>";
  echo 5 / 5 . "<br>";
  echo 5 % 5 . "<br>";
  echo 5 ** 5 . "<br>";
  echo abs(-100) . "<br>";
  echo pow(2, 4) . "<br>";
  echo sqrt(16) . "<br>";
  echo max(2, 10) . "<br>";
  echo min(2, 10) . "<br>";
  echo round(3.2) . "<br>";
  echo ceil(3.2) . "<br>";
  echo floor(3.9) . "<br>";
  echo "<hr>";

  ?>

</body>
</html>