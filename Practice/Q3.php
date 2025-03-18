<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "pizza_shop";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$showAlert = false;
$showError = false;

if (isset($_POST['add_pizza'])) {
  $name = $_POST['name'];
  $category = $_POST['category'];
  $size = $_POST['size'];
  $cost = $_POST['cost'];

  $sql = "INSERT INTO `pizzas` (`name`, `category`, `size`, `cost`) VALUES ('$name', '$category', '$size', '$cost')";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $showAlert = "Pizza added successfully";
  } else {
    $showError = "Failed to add pizza";
  }
}

$search_result = [];
if (isset($_POST['search_pizza'])) {
  $filter = $_POST['filter'];
  $value = $_POST['value'];
  $result = $conn->query("SELECT * FROM pizzas WHERE $filter = '$value'");
  while ($row = $result->fetch_assoc()) {
    $search_result[] = $row;
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Q3</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="menu.php">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> ' . $showAlert . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }

  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> ' . $showError . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>

  <div class="container text-center">
    <h2>Add Pizza</h2>
    <form action="Q3.php" method="POST">
      <input type="text" name="name" placeholder="Pizza Name" required>
      <select name="category">
        <option value="Veg">Veg</option>
        <option value="Non-Veg">Non-Veg</option>
        <option value="Combo">Combo</option>
      </select>
      <select name="size">
        <option value="Small">Small</option>
        <option value="Medium">Medium</option>
        <option value="Large">Large</option>
      </select>
      <input type="number" name="cost" placeholder="Cost" required>
      <button type="submit" name="add_pizza" class="btn btn-success btn-sm">Add Pizza</button>
    </form>


    <h2>Search Pizza</h2>
    <form method="POST" action="Q3.php">
      <select name="filter">
        <option value="cost">By Cost</option>
        <option value="category">By Category</option>
      </select>
      <input type="text" name="value" placeholder="Enter Value">
      <button type="submit" name="search_pizza">Search</button>
    </form>


    <?php if (!empty($search_result)) { ?>
      <h3>Search Results</h3>
      <ul>
        <?php foreach ($search_result as $pizza) { ?>
          <li><?php echo $pizza['name'] . ' - ' . $pizza['category'] . ' - ' . $pizza['size'] . ' - $' . $pizza['cost']; ?></li>
        <?php } ?>
      </ul>
    <?php } ?>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>