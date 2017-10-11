<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>JustFly - The easiest way to fly</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.js"></script>
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

<!-- Display filghts -->
<!--List reservations-->
<div id="services" class="container-fluid text-center">
 <?php
 	$link = mysqli_connect('localhost', 'root', 'root', 'airlinereservation');
	//retrieve flights
	$sql = "SELECT fi.InstanceId, f.flight_no, fi.DepartureDate, fi.DepartTime, fi.ArriveTime, ta.cityName, fa.cityName, fi.Status FROM flight f JOIN flight_Instance fi ON f.flight_no =  fi.Flight_no JOIN Airport ta ON f.from_airport_id = ta.AirportId JOIN Airport fa ON f.to_airport_id = fa.AirportId;";
	$result = mysqli_query($link,$sql);

    $sql1 = "SELECT as.Availability FROM available_seats as JOIN flight_Instance fi ON fi.InstanceId = as.InstanceId;";
	$status="Scheduled";
	if (mysqli_num_rows($result)>0)
	{
		echo("<h2>Flights</h2>");
		echo("<table id='onwardFlight' class='table table-striped' name='onwardflight' data-toggle='table' data-pagination='true' data-search='true'  data-fixed-columns='true'
       data-fixed-number='2'>");
		echo("<thead class='table-inverse'><th style=\"display: none;\"></th><th>Flight Number</th><th data-sortable='true'>Date</th><th data-sortable='true'>Departure Time</th><th data-sortable='true'>Arrival Time</th><th>Source</th><th>Destination</th><th>Available Seats</th><th>Status</th></thead><tbody>");
		//echo("<thead class='table-inverse'><th style=\"display: none;\"></th><th>Flight Number</th><th data-sortable='true'>Date</th><th data-sortable='true'>Departure Time</th><th data-sortable='true'>Arrival Time<th>Source</th><th>Destination</th><th>Available Seats</th><th>Status</th></thead><tbody>");
	while(($row = mysqli_fetch_row($result))!=null)
	{
        $seat = 0;
		$sql1 = "SELECT Availability FROM available_seats WHERE InstanceId = $row[0];";
		//echo $sql1;
		$result1 = mysqli_query($link,$sql1);	
		while(($row1 = mysqli_fetch_row($result1))!=null)
		{
			$seat = $row1[0];
		}
		if($row[7] == "1")
		{
			$status = "Scheduled";
			//echo("<tr><td id='InstanceId' style=\"display: none;\">".$row[0]."</td><td id='FlightNo'>". $row[1]. "</td><td>" .$row[2]. "</td><td>" .$row[3]. "</td><td>" .$row[4]. "</td><td>".$row[5]."</td><td>".$row[6]."</td> <td>".$row[7]."</td></tr>");
			echo("<tr><td id='InstanceId' style=\"display: none;\">".$row[0]."</td><td id='FlightNo'>". $row[1]. "</td><td>" .$row[2]. "</td><td>" .$row[3]. "</td><td>" .$row[4]. "</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$seat."</td> <td>".$status."</td></tr>");
		}
		else
		{
			$status = "Cancelled";
			echo("<tr style='color:red'><td id='InstanceId' style=\"display: none;\">".$row[0]."</td><td id='FlightNo'>". $row[1]. "</td><td>" .$row[2]. "</td><td>" .$row[3]. "</td><td>" .$row[4]. "</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$seat."</td> <td>".$status."</td></tr>");
		}
	}
		echo("</tbody></table>");
	}
 
  ?>
  <button id="cancelFlights" class="btn btn-info btn-lg">Cancel Flight</button>
  <button id="updateInfo" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Update Flight Information </button>
	<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    
		
		
		<form action = "updateFInfo.php" method = "POST" style="width=200px">
<div id="login" >
 		<div class="row" >
		  <h2 class="text-center">What do you want to update?</h2>
			</div>
			 <div class="row">
				<div class="col-xs-6 col-md-6">
			   <input class="form-control" id="flightins" name="flightins" placeholder="Flight Instance" type="text" required>
				</div>
       		 </div><br/>
			<div class="row">
			<div class="col-xs-6 col-md-6">
			  <input class="form-control" id="seats" name="seats" placeholder="Seats" type="text"  ></div>
			</div><br/>
            <div class="row">
			<div class="col-xs-6 col-md-6">
			  <input class="form-control" id="status" name="status" placeholder="Status (s/c)" type="text"></div>
       		 </div><br/>
			
      <div class="row">
        <div class="col-sm-2 form-group"><br/>
         <button class="btn btn-sm btn-primary"  type="submit">Update</button>
		 
        </div>
      </div>
    </div>
</form>

      <!--</div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>-->

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>&copy; Just Fly. All Rights Reserved </p>
</footer>
<script>
$(document).ready(function(){
var InstnceId = null;
var FlightNo = null;
$('#onwardFlight').on('click-row.bs.table', function(e, row, $element){$('#onwardFlight').find('tbody tr.active').removeClass('active'); $element.addClass('active'); InstanceId = $element.find('#InstanceId').html(); FlightNo = $element.find('#FlightNo').html();});

// Post to the provided URL with the specified parameters.
$('#cancelFlights').click(function post(path, parameters) {
    var form = $('<form></form>');

    form.attr("method", "post");
    form.attr("action", "viewFlight.php");
        var field1 = $('<input></input>');
		var field2 = $('<input></input>');

        field1.attr("type", "text");
        field1.attr("name", "id1");
        field1.attr("value", InstanceId);
		
		field2.attr("type", "text");
        field2.attr("name", "id2");
        field2.attr("name", "id2");
        field2.attr("value", FlightNo);

        form.append(field1);
		form.append(field2);
    

    // The form needs to be a part of the document in
    // order for us to be able to submit it.
    $(document.body).append(form);
    form.submit();
});
});
</script>

</body>
</html>