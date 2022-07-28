<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: log.php");
exit;
?>
<html>
<html lang="en">
<head>
<title>SHOP</title>
<meta charset="UTF-8">
<link href="style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}
</style>
</head>

<body>
<div class="header">
<img src="images/shopLogo2.png" >
</div>

<div class="navbar">
  <a href='mainPage.php'>Home</a>
  <a href="contact.php" >Contact</a>
  <a href="author.php">Author</a>
  <input type="text" placeholder="Search..">
  <a href='log.php' class="activeRight" >Account</a>
  <a href="cart.php" class="right" >Cart</a>
</div>

<body>

<div class="main">
  <a href='logOut.php'>Log Out</a>
</div>
</body>

</body>
</html>