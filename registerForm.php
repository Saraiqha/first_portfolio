<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old = isset($_SESSION['old']) ? $_SESSION['old'] : ['fname'=>'','lname'=>'','email'=>''];
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
// clear messages so they don't persist
unset($_SESSION['errors'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html>
<head>
<title>Insert Data</title>
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
    <h2>Register Form Submission</h2>
    <h5>Please insert your data correctly </h5>
    <div class="fakeimg">
      <?php if (!empty($errors)): ?>
        <div class="error">
          <?php foreach ($errors as $err): ?>
            <div><?php echo htmlspecialchars($err); ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="success">
          <?php echo htmlspecialchars($success); ?>
        </div>
      <?php endif; ?>

      <form action="insertData.php" method="POST" novalidate>
        First Name: <input type="text" name="fname" required value="<?php echo htmlspecialchars($old['fname']); ?>"><br>
        Last Name: <input type="text" name="lname" required value="<?php echo htmlspecialchars($old['lname']); ?>"><br>
        E-mail: <input type="email" name="email" required value="<?php echo htmlspecialchars($old['email']); ?>"><br>
        <input type="submit">
      </form>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>