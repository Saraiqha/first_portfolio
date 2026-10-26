<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Delete Data</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="stylesheet.css">

</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>

<!-- Navigation Bar -->
<?php include 'navigation.php'; ?>

<!-- Content Container -->
<div class="container">
  <div class="side">
    <h2>About Me</h2>
    <h5>Photo of me:</h5>
    <div class="fakeimg">Image</div>
  </div>
  <div class="main">
    <h2>Delete Data</h2>
    <h5>Enter the ID of the record to delete</h5>
    <div class="fakeimg">
      <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $id = trim($_POST['id'] ?? '');
          if (empty($id) || !is_numeric($id)) {
              echo "<p class=\"error\">Please enter a valid ID.</p>";
          } else {
              include 'dblink.php';
              try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("DELETE FROM MyGuests WHERE id = :id");
                  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                  $stmt->execute();
                  if ($stmt->rowCount() > 0) {
                      echo "<p class=\"success\">Record deleted successfully.</p>";
                  } else {
                      echo "<p class=\"error\">No record found with that ID.</p>";
                  }
              } catch(PDOException $e) {
                  echo "<p class=\"error\">Error: " . htmlspecialchars($e->getMessage()) . "</p>";
              }
              $conn = null;
          }
      }
      ?>
      <form method="POST" action="deleteForm.php">
        ID: <input type="number" name="id" required><br><br>
        <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this record?')">
      </form>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>