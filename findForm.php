<?php
?>
<!DOCTYPE html>
<html>
<head>
<title>Find Data</title>
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
    <h2>Find Data</h2>
    <h5>Search for data by first name or email</h5>
    <div class="fakeimg">
      <form method="GET" action="findForm.php">
        Search by First Name: <input type="text" name="fname" value="<?php echo htmlspecialchars($_GET['fname'] ?? ''); ?>"><br><br>
        Or by Email: <input type="email" name="email" value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>"><br><br>
        <input type="submit" value="Search">
      </form>
      <br>
      <?php
      if (isset($_GET['fname']) || isset($_GET['email'])) {
          include 'dblink.php';
          try {
              $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
              $fname = trim($_GET['fname'] ?? '');
              $email = trim($_GET['email'] ?? '');
              
              $query = "SELECT id, firstname, lastname, email, reg_date FROM MyGuests WHERE ";
              $params = [];
              
              if (!empty($fname)) {
                  $query .= "firstname LIKE :fname";
                  $params[':fname'] = '%' . $fname . '%';
              }
              if (!empty($email)) {
                  if (!empty($fname)) $query .= " AND ";
                  $query .= "email LIKE :email";
                  $params[':email'] = '%' . $email . '%';
              }
              if (empty($fname) && empty($email)) {
                  echo "Please enter a search term.";
                  $conn = null;
                  exit;
              }
              
              $stmt = $conn->prepare($query);
              $stmt->execute($params);
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
              if (count($result) > 0) {
                  echo "<h3>Search Results:</h3>";
                  echo "<table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Registration Date</th></tr>";
                  foreach ($result as $row) {
                      echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['firstname']) . "</td><td>" . htmlspecialchars($row['lastname']) . "</td><td>" . htmlspecialchars($row['email']) . "</td><td>" . htmlspecialchars($row['reg_date']) . "</td></tr>";
                  }
                  echo "</table>";
              } else {
                  echo "No matching data found.";
              }
          } catch(PDOException $e) {
              echo "Error: " . htmlspecialchars($e->getMessage());
          }
          $conn = null;
      }
      ?>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>