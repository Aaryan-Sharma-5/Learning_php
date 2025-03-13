<?php include 'include/header.php'; ?>

<?php
$sql = 'SELECT * FROM feedback';
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h2>Past Feedback</h2>

<?php if(empty($feedback)): ?>
  <div class="alert alert-info">No feedback yet</div>
<?php endif; ?>

<?php foreach($feedback as $fb): ?>
  <div class="card my-3 w-75">
    <div class="card-body text-center">
      <h4><?php echo $fb['name']; ?></h4>
      <small><?php echo $fb['email']; ?></small>
      <p><?php echo $fb['body']; ?></p>
    </div>
  </div>
<?php endforeach; ?>


<?php include 'include/footer.php'; ?>