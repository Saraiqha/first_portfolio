<?php
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
?>

<html>
<body>

Welcome <?php echo $fname ." " . $lname; ?><br>
Your email address is: <?php echo $_POST["email"]; ?>

</body>
</html>