<?php
session_start();

if (isset($_SESSION['name'])) {
  echo 'Welcome ' . $_SESSION['name'];
} else {
  echo 'You are not logged in';
}

if (isset($_POST['submit'])) {
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

  $password = $_POST['password'];

  if ($name == 'admin' && $password == 'password') {
    $_SESSION['name'] = $name;
    header('Location: session.php');
  } else {
    echo 'Invalid username or password';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div>
      <label for="name">Name</label>
      <input type="text" name="name">
      <label for="password">Password</label>
      <input type="password" name="password">
      <button type="submit" name="submit">Submit</button>
    </div>
  </form>

</body>

</html>