<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Just Fly - Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
  <script src="js/home.js"></script>
 
  
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
       <!--<a class="navbar-brand" href="home.html"></a>--><img src="images/logo1.png" alt="JustFly"/>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
       <ul class="nav navbar-nav navbar-right">
        
		<?php
		if(isset($_SESSION['admin_email']))
		{
			echo("<li><a href='updateFlightsPage.php'>ADMIN HOME</a></li>");
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
<h1> Flight Update successful!</h1>
<p><a href="ViewFlightsAdmin.php">View Flights</a></p>

</div>
<footer class=" text-center bg-lightgray">

        <div class="copyrights" style="margin-top:0px; height:5px">
            <p>&copy; 2017 GoComets Group. All Rights Reserved.
                <br>
                <span>Web Design By: Adithya, Madhurya & Preetha</span></p>
            <p><a href="https://www.linkedin.com/" target="_blank">Linkedin <i class="fa fa-linkedin-square" aria-hidden="true"></i> </a></p>
        </div>
</footer>
</body>
</html>