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
  <a href="contact.php">Contact</a> 
  <a href="author.php" class="active">Author</a>
  <form class="searchBar" action="searchResults.php" method="GET">
  <input type="text" placeholder="Search.." name="search">
</form>
  <a href='log.php' class="right">Account</a>
  <a href="cart.php" class="right">Cart</a>
</div>

<script type="text/javascript" src="1.js"></script>

<div class="main">
	<h1 style="text-align:center;">Autor: Kamil Szkaradek</h1>
	<br></br>
	<h2 style="text-align:center;">Moja ocena projektu - 70%</h2>
	<br></br>
	<h2 style="text-align:center;">Udział w pracach: 100%</h2>
	<br></br>
  </div>
</div>


</body>
</html>
