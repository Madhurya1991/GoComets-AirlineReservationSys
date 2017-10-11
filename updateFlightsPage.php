<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <title>GoComets - Update Flights</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
  
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" class="shortPage">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="home.html"></a>-->
	  <img src="images/logo1.png" alt="JustFly"/>
	<div class="collapse navbar-collapse" id="myNavbar1" style="float:right">
      <ul class="nav navbar-nav navbar-right">
	<?php

		if(isset($_SESSION['admin_email']))
		{
			echo("<li><a> User: ADMIN</a></li>");
		}?>
	</ul>
	</div>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
       <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="home.html">HOME</a></li>-->
		<?php
		if(isset($_SESSION['admin_email']))
		{
			//echo("<li><a href='updateFlightsPage.php'>UPDATE FLIGHTS</a></li>");
			echo("<li><a href='AdminLogout.php'>LOG OUT</a></li>");			
		}
		else
		{
			echo('<li><a href="Admin_signInPage.php">LOG IN</a></li>');
		}
		?>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
<?php
if(!isset($_SESSION['admin_email']))
{
	header("Location : Admin_signInPage.php");
}
?>
<h3> Welcome Admin !!</h3>
<br/>

<form action="AddFlights.php" class="form-inline" method="POST" >
  <button type="button" class="btn btn-info"><a id="aa" href="AddFlightsPage.php">Manage Flights</a></button>
</form>
<br/>
<form  class="form-inline" >
  <button type="button" class="btn btn-info"><a id="aa" href="ViewFlightsAdmin.php">View Flights</a></button>
</form>
<br/>
<form  class="form-inline" >
  <button type="button" class="btn btn-info"><a id="aa" href="changeLogo.php">Change Logo</a></button>
</form>
</div>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>&copy; 2017 GoComets Group. All Rights Reserved </p>
</footer>
</body>
</html>