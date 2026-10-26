<?php
include 'dblink.php';

// Only handle POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  // Redirect to the form page
  header('Location: registerform.php');
  exit;
}

// Sanitize and trim input
$fname = isset($_POST['fname']) ? trim($_POST['fname']) : '';
$lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Server-side validation: required fields and valid email
$errors = [];
if ($fname === '') {
  $errors[] = 'First name is required.';
}
if ($lname === '') {
  $errors[] = 'Last name is required.';
}
if ($email === '') {
  $errors[] = 'Email is required.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = 'Please enter a valid email address.';
}

if (!empty($errors)) {
  // Store errors and old input, then redirect back to form
  session_start();
  $_SESSION['errors'] = $errors;
  $_SESSION['old'] = ['fname' => $fname, 'lname' => $lname, 'email' => $email];
  header('Location: registerform.php');
  exit;
}

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Use prepared statement to avoid SQL injection
  $stmt = $conn->prepare('INSERT INTO MyGuests (firstname, lastname, email) VALUES (:fname, :lname, :email)');
  $stmt->bindParam(':fname', $fname);
  $stmt->bindParam(':lname', $lname);
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  // Success, store message and redirect
  session_start();
  $_SESSION['success'] = 'New record created successfully';
  header('Location: registerform.php');
  exit;
} catch(PDOException $e) {
  // Error, store message and redirect
  session_start();
  $_SESSION['errors'] = ['Database error: ' . $e->getMessage()];
  header('Location: registerform.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Insert Data</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial;
  margin: 0;
}

/* Header */
header {
  padding: 50px;
  text-align: center;
  background: #1abc9c;
  color: white;
}

/* Top navigation bar */
.navbar {
  display: flex;
  background-color: #333;
}

/* Navigation bar links */
.navbar a {
  color: white;
  padding: 14px 20px;
  text-decoration: none;
  text-align: center;
}

/* Change color on hover */
.navbar a:hover {
  background-color: #ddd;
  color: black;
}

/* Column container */
.container {  
  display: flex;
  flex-wrap: wrap;
}

/* Sidebar/left column */
.side {
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {
  flex: 70%;
  background-color: white;
  padding: 20px;
}

/* Fake image, just for this example */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Footer */
footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
}

/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
  .container, .navbar {   
    flex-direction: column;
  }
}
</style>
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
    <div class="fakeimg" style="height:200px;">Image</div>
  </div>
  <div class="main">
    <h2>Check my database Connection</h2>
    <h5>I'm using the include function </h5>
    <div class="fakeimg" style="height:200px;">
    <p>This page processes form submissions. Please use the registration form.</p>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>