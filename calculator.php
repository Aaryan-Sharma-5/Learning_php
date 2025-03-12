<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="calculator.php" method="get">
    Number 1: <input type="number" name="num1">
    <br>
    Number 2: <input type="number" name="num2">
    <br>
    Operator: <input type="text" name="operator">
    <br>
    <input type="submit">
  </form>

  <?php
  if (isset($_GET["num1"]) && isset($_GET["num2"]) && isset($_GET["operator"])) {
    $num1 = $_GET["num1"];
    $num2 = $_GET["num2"];
    $operator = $_GET["operator"];
    $answer = '';

    switch ($operator) {
      case '+':
        $answer = $num1 + $num2;
        break;
      case '-':
        $answer = $num1 - $num2;
        break;
      case '*':
        $answer = $num1 * $num2;
        break;
      case '/':
        if ($num2 != 0) {
          $answer = $num1 / $num2;
        } else {
          $answer = 'Division by zero error';
        }
        break;
      default:
        $answer = 'Invalid operator';
        break;
    }

    echo "Answer: " . $answer;
  }
  ?>

</body>

</html>