<?php
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: account.php");
    exit;
}

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

function PasswordValidation($password)
{
	if(strlen($password)>5)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function LoginValidation($login, $connection)
		{
			if(strlen($login)>5)
			{
				openConnection();
				$quer = "select * from users";
				$res = mysqli_query($connection, $quer);;
				$isUnique = true;
				while($row = mysqli_fetch_array($res))
				{
					if($login == $row[1])
					{
						$isUnique = false;
						break;
					}
				}
				return $isUnique;
			}
			else
			{
				return false;
			}
		}
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
  <title>Registration</title>
  <style> input[type='text'] { text-align: left } 
  
  .container {
    position: absolute;
    top: 46%;
    left: 50%;
	
    -moz-transform: translateX(-50%) translateY(-50%);
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
	}
  </style>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="header">
<img src="images/shopLogo2.png" >
</div>

<div class="navbar">
  <a href='mainPage.php' >Home</a>
  <a href="contact.php">Contact</a>
  <a href="author.php">Author</a>
  <input type="text" placeholder="Search.." name="search">
  <a href='log.php' class="activeRight">Account</a>
  <a href="cart.php" class="right">Cart</a>
</div>

<body style='background: white; color: black'> 
<div class="container">
<br><center>

<br><center>
<body style='background: white; color: black'>
<br><center>

<?php
	
	if(isset($_POST['login'])) {			
		foreach($_POST as $name=>$value) { eval("\$$name='$value';"); };        
		openConnection();
		$query0 = "SELECT MAX(userID) FROM users";
		$result = mysqli_query($connection, $query0);
		$row = mysqli_fetch_array($result);
		$newID = $row[0] + 1;
		
		
		if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && 
		(LoginValidation($login, $connection) == true) && (PasswordValidation($password) == true)){
			
		  $query = "insert into users (userID, login, password, email) values('$newID','$login', '$password', '$email');";
		  mysqli_query($connection, $query);
		  closeConnection();		
		  echo "<a href='log.php'> Back to LOG IN page </a>";
		}
		else
		{
			echo "Please correct your registration form.";
			echo "<a href='registration.php'> Back to REGISTARTION page </a>";
		}
		
		
	}
	else {
?>
<div class="container">
<form method=POST action=''> 
<table border=0>
<tr>
<td>Login:</td><td colspan=2><input type=text name='login' size=15 style='text-align: left'></td>
</tr>
<tr>
<td>E-mail:</td><td colspan=2><input type=text name='email' size=15 style='text-align: left'></td>
</tr>
<tr>
<td>Password:</td><td colspan=2><input type=password name='password' size=15 style='text-align: left'></td>
</tr>
<tr>
<td colspan=3><input type=submit value='Register' style='width:200'></td>
</tr>
</table>
</form>
If you already have an account, please <a href='log.php'>LOG IN</a>
</div>
</div>

<?php } // koniec else ?>

</center>
</body>
</html>
