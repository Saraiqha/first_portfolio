<!DOCTYPE html>
<html>
<head>
<title>Home</title>
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
<header>
  <h1>Khai's Website</h1>
  <p>Connecting the Database with <b>My Website</b> layout.</p>
</header>

<!-- Navigation Bar -->
<div class="navbar">
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#">Link</a>
</div>

<!-- Content Container -->
<div class="container">
  <div class="side">
    <h2>About Me</h2>
    <h5>Photo of me:</h5>
    <div class="fakeimg" style="height:200px;">Image</div>
  </div>
  <div class="main">
    <h2>TITLE HEADING</h2>
    <h5>Title description, Oct 7, 2025</h5>
    <div class="fakeimg" style="height:200px;">Image
    <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <h2>Footer</h2>
</footer>

</body>
</html>