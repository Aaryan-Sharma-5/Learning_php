<?php include 'include/header.php'; ?>

<?php
$name = $email = $body = '';
$errors = ['name' => '', 'email' => '', 'body' => ''];

if(isset($_POST['submit'])) {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $body = htmlspecialchars($_POST['body']);

  if(empty($name)) {
    $errors['name'] = 'Name is required';
  } else {
    if(!preg_match('/^[a-zA-Z\s]+$/', $name)) {
      $errors['name'] = 'Name must be letters and spaces only';
    }
  }

  if(empty($email)) {
    $errors['email'] = 'Email is required';
  } else {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Email must be a valid email address';
    }
  }

  if(empty($body)) {
    $errors['body'] = 'Feedback is required';
  } else {
    if(strlen($body) < 10) {
      $errors['body'] = 'Feedback must be at least 10 characters';
    }
  }

  if(!array_filter($errors)) {
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $body = mysqli_real_escape_string($conn, $body);

    $sql = "INSERT INTO feedback(name, email, body) VALUES('$name', '$email', '$body')";

    if(mysqli_query($conn, $sql)) {
      header('Location: index.php');
    } else {
      echo 'Query error: ' . mysqli_error($conn);
    }
  }
}
?>

<h2>Feedback</h2>
<p class="lead text-center">Leave feedback</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="mt-4 w-75">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
    <div class="text-danger"><?php echo $errors['name']; ?></div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
    <div class="text-danger"><?php echo $errors['email']; ?></div>
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">Feedback</label>
    <textarea class="form-control" id="body" name="body" placeholder="Enter your feedback"></textarea>
    <div class="text-danger"><?php echo $errors['body']; ?></div>
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
  </div>
</form>
<?php include 'include/footer.php'; ?>