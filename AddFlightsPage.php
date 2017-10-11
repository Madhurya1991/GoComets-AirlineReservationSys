<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Add Flights</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" href="css/home.css">
  <script src="js/home.js"></script>
 <style>
  .alignleft {
           position: relative;
            float: left;
            width: 30%;
        }
 </style>
  
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
      <!--<a class="navbar-brand" href="home.html"></a>--><img src="images/logo1.png" alt="GoComets"/>
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
			header("Location : Admin_signInPage.php");
		}
		?>
      </ul>
    </div>
  </div>
</nav>


<div class="jumbotron text-center">
<h1 class="alignleft">Add Flight</h1>
    <div class="row">
        <div class="col-xs-12" >
            <form class="form" role="form" action="AddFlights.php" method ="POST">
            <table class="table table-inverse table-bordered cellpadding ="10">
            <tr>
            
            <td> <label for = "flight_no">Flight Number</label><input class="form-control" name="flight_no" id = "flight_no" placeholder="Flight Number" /></td>
            <td><label for = "flight_Instance">Flight Instance</label><input class="form-control" name="flight_Instance" id= "flight_Instance" placeholder="Flight Instance"  /></td>
			
			<td><label for = "from">Source ID </label><input class="form-control" name="from" id = "from" placeholder="From Airport Id"  /> </td>
            <td> <label for = "to">Destination ID </label><input class="form-control" name="to" id= "to" placeholder="To Airport Id"  /></td>
			
			<td><label for = "fromCity">Source City</label><input class="form-control" name="fromCity" id = "fromCity" placeholder="From City"  /> </td>
            <td> <label for = "toCity">Destination City</label><input class="form-control" name="toCity" id= "toCity" placeholder="To City"  /></td>

			<td><label for = "fromState">Source State</label><input class="form-control" name="fromState" id = "fromState" placeholder="From State"  /> </td>
            <td> <label for = "toState">Destination State</label><input class="form-control" name="toState" id= "toState" placeholder="To State"  /></td>
			 </tr>
			 <tr>
			 <td><label for = "category">Category</label><input class="form-control" name="category" id = "category" placeholder="Category"  /></td>
			<td><label for = "seats">Seat Availability</label><input class="form-control" name="seats" id = "seats" placeholder="Available Seats"  /></td>
			
			<td><label for = "depart_time">Departure Time</label><input class="form-control" name="depart_time" id = "depart_time" placeholder="Departure Time" type="time"/></td>
             <td><label for = "arrive_time">Arrival Time</label><input class="form-control" name="arrive_time" id= "arrive_time" placeholder="Arrival Time" type="time"/></td>
			 
			<td> <label for = "arrive_date">Arrival Date</label><input class="form-control" name="arrive_date" id= "arrive_date" placeholder="Arrival Date"  type="date"/></td>
            <td> <label for = "depart_date">Departure Date</label><input class="form-control" name="depart_date" id= "depart_date" placeholder="Departure Date"  type="date"/></td>
			  
			<td> <label for = "arrive_date">Fare</label><input class="form-control" name="fare" id= "fare" placeholder="Fare"  type="number" min="0"/></td>
			  </tr>
			  </table>
			  
			 <br/>
            <button class="btn btn-md btn-primary" type="submit">Add Flight</button>
            </form>
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