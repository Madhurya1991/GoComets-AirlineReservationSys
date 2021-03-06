<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>GoComets | User Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
  <script src = "js/home.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="home.html"></a>-->
	  <img src="images/logo1.png" alt="GoComets"/>
	 
	  
    </div>
<div class="collapse navbar-collapse" id="myNavbar1" style="float:left">
      <ul class="nav navbar-nav navbar-right">
 <?php

		if(isset($_SESSION['user_fname']))
		{
			echo("<li><a> User: ". $_SESSION['user_fname']."</a></li>");
		}?>
</ul>
</div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="home.html">HOME</a></li>-->
		
        <li><a href="viewFlights.php">FLIGHTS</a></li>
		<?php
		
		if(isset($_SESSION['user_fname']))
		{
			echo("<li><a href='viewReservations.php'>MYTRIPS</a></li>");
			echo("<li><a href='logout.php'>LOG OUT</a></li>");
									
		}
		else
		{
			echo('<li><a href="loginPage.php">LOG IN</a></li>');
			//echo('<li><a href="signUp.html">SIGN UP</a></li>');
		}
		?>
      </ul>
    </div>
  </div>
</nav>

<!--Signup-->
<div class="jumbotron text-center">
<h1>Hi  <?php echo $_SESSION['user_fname'] ?> !!! </h1><br/>
<h3> Following are your reservations </h3>

<!--List reservations-->
<div id="services" class="container-fluid text-center">
 <?php
  if(isset($_SESSION['username']))
  {
	//echo ("<h3>Hi ". $_SESSION['user_fname']. "!</h3>");
	$username = $_SESSION['username'];
	$link = mysqli_connect('localhost', 'root', 'root', 'airlinereservation');
	//check if user with same username exists in db
	$sql = "SELECT r.reservationId, f.flight_no, fi.DepartTime, fi.DepartureDate, fa.cityName, ta.cityName, fi.ArriveTime, fi.ArrivalDate, r.ReturnInstanceId, fi.status FROM reservation r JOIN user u ON r.username = u.UserName JOIN Flight_Instance fi ON r.InstanceId = fi.InstanceId JOIN flight f ON fi.flight_no = f.flight_no JOIN airport fa ON f.from_airport_id = fa.airportId JOIN airport ta ON f.to_airport_id = ta.airportId WHERE u.username = '".$username."';";
	$result = mysqli_query($link,$sql);

	if (mysqli_num_rows($result)>0)
	{
		echo("<table class='table '>");
		echo("<thead><th>Booking ID</th><th>Flight Number</th><th>Departure Time</th><th>Arrival Time</th><th>Source</th><th>Destination</th><th>Status</th></thead><tbody>");
	$i=0;
	while(($row = mysqli_fetch_row($result))!=null)
	{
		$flightStatus = $row[9];
		if($flightStatus == 0)
		{
			//echo("<tr><td colspan = '6'><strong>Flight: $row[1] This flight has been cancelled. Please contact GoComets for further information</strong></td></tr>");
			echo("<tr style='color:orange' data-target='#accordion$i'><td>".$row[0]. "</td><td> " . $row[1]. "</td><td> ". $row[2]." on ". $row[3]."</td><td>". $row[6]. " on ".$row[7]."</td><td>". $row[4]. "</td><td>". $row[5]. "</td><td>Cancelled</td></tr>");
		}
		else
		{
		//echo("<tr data-target='#accordion$i'><td>".$row[0]. "</td><td> " . $row[1]. "</td><td> ". $row[2]. "</td><td> ". $row[3]."</td><td>". $row[4]. "</td><td>". $row[5]. "</td><td>Scheduled</td></tr>");
		echo("<tr data-target='#accordion$i'><td>".$row[0]. "</td><td> " . $row[1]. "</td><td> ". $row[2]." on ". $row[3]."</td><td>". $row[6]. " on ".$row[7]."</td><td>". $row[4]. "</td><td>". $row[5]. "</td><td>Scheduled</td></tr>");
		
		
		/*echo("<tr>
            <td colspan='7'>
                <div id='accordion$i' >Arrival at destination:<br/> Time: ". $row[6]. " Date:   ". $row[7]);*/
		$i++;
		$returnInstanceId = $row[8];
		if($returnInstanceId!=null)
		{
			$sql1 = "SELECT Flight_no, DepartTime, DepartureDate, ArriveTime, ArrivalDate, Status FROM Flight_instance WHERE InstanceId = '$returnInstanceId';";
			$result1 = mysqli_query($link,$sql1);
			if ( mysqli_num_rows($result1)>0)
			{
				$row1 = mysqli_fetch_row($result1);
				$retFlightStatus = $row1[5];
				if($retFlightStatus == 0)
				{
				  echo("<strong>Flight: $row1[0] This flight has been cancelled. Please contact Just Fly for further information</strong>");
				}
				else
				{
					echo("<br />Return Flight: $row1[0] <br/>Depart Time: ". $row1[1]. " Depart Date:   ". $row1[2]. " <br/>Arrive Time: ". $row1[3]. " Arrive Date:   ". $row1[4]);
				}
			}
		}
		echo("<br/></div></td></tr>");
		}
	}
		echo("</tbody></table>");
	}
	else
	{
		echo("Currently you have no reservations.");
		//echo ($sql);
	}
  }
  else{
	  header("Location: home.html");
  }
  ?>
</div>
 </div>   
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

