<html>
<html lang="en">
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<title>SHOP</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=3">
<style>
* {box-sizing: border-box;}
.search-results {
    display: grid;
    grid-template-columns: repeat(3,minmax(0,1fr));
    grid-column-gap: 10px;
}
a { text-decoration: none; }
</style>
</head>
<body>
<div class="header">
<img src="images/shopLogo2.png" >
</div>

<div class="navbar">
  <a href='mainPage.php'>Home</a>
  <a href="contact.php">Contact</a> 
  <a href="author.php">Author</a>
  <form class="searchBar" action="searchResults.php">
  <input type="text" placeholder="Search.." name="search"></form>
  <a href='log.php' class="right">Account</a>
  <a href="cart.php" class="right">Cart</a>
</div>

<div class="row">
  <div class="side">
    <h2>Categories</h2>
  <a href="searchResults.php?searchC=furniture">Furniture</a>
  <a href="searchResults.php?searchC=garden">Garden</a>
  <a href="searchResults.php?searchC=health">Health</a>
  <a href="searchResults.php?searchC=vehicles">Vehicles</a>
  <a href="searchResults.php?searchC=electronics">Electronics</a>
  <a href="searchResults.php?searchC=art">Art</a>
  <a href="searchResults.php?searchC=food">Food</a>
</div>

  <div class="main">
	<form action="cart.php" method="get">
<?php
		function openConnection(){
			global $connection;
			$server = "127.0.0.1";
			$user = "root";
			$password = "";
			$dbase = "shop";
			$connection = mysqli_connect($server, $user, $password) or exit("Connection with database server failed");
			mysqli_select_db($connection, $dbase) or exit();
			mysqli_set_charset($connection, "utf8");
		}
		
		function closeConnection(){
			global $connection;
			mysqli_close($connection);
		}
		
		if (isset($_GET['search']))
		{
			$name = $_GET['search'];
			openConnection();
			$query = "select * from products where productName LIKE '$name' ORDER BY rand() LIMIT 5";
			$products = mysqli_query($connection, $query) or exit();
			$result = mysqli_query($connection, $query);
			echo "<h2>SEARCH RESULTS:</h2>";
			echo "<div style='display: flex;'>";
			while($row = mysqli_fetch_array($result))
			{
				echo "<div class='card' style='width: 300px' style='text-align:center'> <img src='".$row[7].
				"' style='width:70%'/><div> <p>".$row[1]."</p> <footer><p class='price'>".
				$row[3]-$row[6]. "$</p></footer>". "<p><button type='submit' name='product' value='$row[0]'>Add to Cart</button ></p> </div></div>";
				echo "<div> </div>";
			}
			echo "</div><br>";
			closeConnection();
		}
		
	    if (isset($_GET['searchC']))
		{
			$name = $_GET['searchC'];
			openConnection();
			$query = "select * from products where category='$name' ORDER BY rand() LIMIT 5";
			$products = mysqli_query($connection, $query) or exit();
			$result = mysqli_query($connection, $query);
			echo "<h2>PRODUCTS FROM SELECTED CATEGORY:</h2>";
			echo "<div style='display: flex;'>";
			while($row = mysqli_fetch_array($result))
			{
				echo "<div class='card' style='width: 300px' style='text-align:center'> <img src='".$row[7].
				"' style='width:70%'/><div> <p>".$row[1]."</p> <footer><p class='price'>".
				$row[3]-$row[6]. "$</p></footer>". "<p><button type='submit' name='product' value='$row[0]'>Add to Cart</button ></p> </div></div>";
				echo "<div> </div>";
			}
			echo "</div><br>";

			closeConnection();
		}
		
?>
	</form>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
	<br></br>
  </div>
</div>

<div class="footer">
  <h2></h2>
</div>

</body>
</html>
