<?php
session_start();

if (!isset($_SESSION['result'])) {
  $_SESSION['result'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['clear'])) {
    session_destroy();
    session_start();
    $_SESSION['result'] = 0;
  } elseif (isset($_POST['operator']) && isset($_POST['num1']) && isset($_POST['num2'])) {
    $num1 = floatval($_POST['num1']);
    $num2 = floatval($_POST['num2']);
    $operator = $_POST['operator'];

    switch ($operator) {
      case '+':
        $_SESSION['result'] = $num1 + $num2;
        break;
      case '-':
        $_SESSION['result'] = $num1 - $num2;
        break;
      case '*':
        $_SESSION['result'] = $num1 * $num2;
        break;
      case '/':
        $_SESSION['result'] = ($num2 != 0) ? $num1 / $num2 : 'Error';
        break;
      default:
        $_SESSION['result'] = 'Invalid operator';
        break;
    }
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Q2</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/
bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/
Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
  <h1>Calculator</h1>
  <form action="index.php" method="POST">
    Number 1: <input type="number" name="num1">
    <br>
    Number 2: <input type="number" name="num2">
    <br>
    <button type="submit" name="operator" value="+">+</button>
    <button type="submit" name="operator" value="-">-</button>
    <button type="submit" name="operator" value="*">*</button>
    <button type="submit" name="operator" value="/">/</button>
    <br>
    <button type="submit" name="calculate">=</button>
    <button type="submit" name="clear">C</button>
  </form>
  <h3>Result: <?= $_SESSION['result'] ?></h3>

</body>

</html>