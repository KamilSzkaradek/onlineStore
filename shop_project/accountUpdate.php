<?php
	session_start();
	function openConnection(){
			global $connection;
			$server = "127.0.0.1";
			$user = "root";
			$password = "";
			$dbase = "shop";

			$connection = mysqli_connect($server, $user, $password) or exit("Connection with database server failed");
			mysqli_select_db($connection, $dbase) or exit("Connection with database $dbase failed");
			mysqli_set_charset($connection, "utf8");
		}
		
		function closeConnection(){
			global $connection;
			mysqli_close($connection);
		}
		
?>
<html>
<html lang="en">
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<title>SHOP</title>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=3">
<style>
* {box-sizing: border-box;}
.main {   
  -ms-flex: 70%; /* IE10 */
  flex: 70%;
  background-color: white;
  padding: 70px;
  width: 1200px;

}
</style>
</head>
<body>
<div class="header">
<img src="images/shopLogo2.png" >
</div>

<div class="navbar">
  <a href='mainPage.php'>Home</a>
  <a href="contact.php" class="active">Contact</a> 
  <a href="author.php">Author</a>
  <form class="searchBar" action="searchResults.php" method="GET">
  <input type="text" placeholder="Search.." name="search">
</form>
  <a href='log.php' class="right">Account</a>
  <a href="cart.php" class="right">Cart</a>
</div>

<script type="text/javascript" src="1.js"></script>
<?php
	if(isset($_GET['email']) && isset($_GET['firstname']) &&
	isset($_GET['lastname']) && filter_var($_GET["email"], FILTER_VALIDATE_EMAIL))
	{
?>
<div class="main">
	<h1 style="text-align:center;">Update successful!</h1>
	<br></br>
  </div>
</div>
<?php 		
	openConnection();
	$email = $_GET['email'];
	$name = $_GET['firstname'];
	$surname = $_GET['lastname'];
	$userID = $_GET['userID'];
	$phone = $_GET['phone'];
	$query = "UPDATE users SET email='$email', name='$name', surname='$surname', mobile='$phone' WHERE userID=$userID";
	mysqli_query($connection, $query);
	closeConnection();
	}
	else{
 ?>
 <div class="main">
	<h1 style="text-align:center;">Update failed.</h1>
	<br></br>
  </div>
</div>
<?php
	}
?>
</body>
</html>
