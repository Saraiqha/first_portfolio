<?php
?>
<!DOCTYPE html>
<html>
<head>
<title>Display Data</title>
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
    <h2>All Inserted Data</h2>
    <h5>Displaying all records from the database</h5>
    <div class="fakeimg">
      <?php
      include 'dblink.php';
      try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT id, firstname, lastname, email, reg_date FROM MyGuests");
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if (count($result) > 0) {
              echo "<table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Registration Date</th></tr>";
              foreach ($result as $row) {
                  echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['firstname']) . "</td><td>" . htmlspecialchars($row['lastname']) . "</td><td>" . htmlspecialchars($row['email']) . "</td><td>" . htmlspecialchars($row['reg_date']) . "</td></tr>";
              }
              echo "</table>";
          } else {
              echo "No data found.";
          }
      } catch(PDOException $e) {
          echo "Error: " . htmlspecialchars($e->getMessage());
      }
      $conn = null;
      ?>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>