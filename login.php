<?php
//header("Location: signUp.html");
session_start();
$email = $_POST['username'];
$password = $_POST['password'];
// connect to the mysql database
$link = mysqli_connect('localhost', 'root', 'root', 'airlinereservation');
//check if user with same username exists in db
$sql = "SELECT password, firstname, lastname FROM user WHERE username = '".$email."';";
echo $sql;
$result = mysqli_query($link,$sql);
// check if user is admin
$sql1 = "SELECT username FROM admin WHERE password = '".$password."';";
echo $sql1;
$result1 = mysqli_query($link,$sql1);
if($result)
{
	$row = mysqli_fetch_row($result);
	//echo $row[0]. " ".$row[1]. " ". $row[2];
	//if($row!=null && strcasecmp($row[0], $password) == 0)
	if($row!=null && password_verify($password, $row[0]))
	{
		echo "user page";
		$_SESSION['user_fname'] = $row[1];
		$_SESSION['user_lastname'] = $row[2];
		$_SESSION['username'] = $email;
		session_write_close();
		echo "Authenticated";
		//Redirect to redirecting page 
				if(isset($_POST['redirurl'])) 
				{
					$url = $_POST['redirurl']; // holds url for last page visited. 
					header("Location:$url");
				}
				else
				{
					//echo ("Redirected from:". $_POST['redirurl']);
					header("Location: viewReservations.php");
				}
	}
	else if($result1)
	{
		
		if($result1->num_rows == 0)
		{
			$_SESSION['error_msg'] = "Login Failed.";
			session_write_close();
			header("Location: errorPage.php");
		}
		else
			{
			echo "admin page";
			$_SESSION['admin_email'] = $email;
			header("Location: updateFlightsPage.php");
			//echo("<li><a href='updateFlightsPage.php'>UPDATE FLIGHTS</a></li>");
			//echo("<li><a href='AdminLogout.php'>LOG OUT</a></li>");	
			}
	}
	else
	{
		$_SESSION['error_msg'] = "Login Failed.";
		session_write_close();
		header("Location: errorPage.php");
	}
}
else
	{
		$_SESSION['error_msg'] = "Login Failed.";
		session_write_close();
		header("Location: errorPage.php");
	}
?>