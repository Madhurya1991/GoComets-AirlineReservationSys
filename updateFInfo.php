<?php
	$con= mysqli_connect("localhost","root","root","AirlineReservation");
	
	if(!$con){
		die("Connection failed : ".mysqli_connect_error());
	}
	session_start();

	$flight_ins = $_POST['flightins'];
	$seats = $_POST['seats'];
	$schedule = $_POST['status'];

	if(!empty($seats))
	{
	$sql = "UPDATE available_seats SET Availability = '$seats' WHERE InstanceId = '$flight_ins' AND Total_Seats > '$seats';";
	echo $sql;
	if(mysqli_query($con, $sql))
	{
		header('Location: updateSuccess.php');
	}
	else
	{
		$_SESSION['error_msg'] = "Update Unsuccessfull";
		header('Location: errorPage.php');
	}
	}

	if(!empty($schedule))
	{
		if($schedule == 'c')
			$status = 0;
		else if($schedule == 's')
			$status = 1;
		$sql = "UPDATE flight_instance SET Status='$status' WHERE InstanceId = '$flight_ins';";
		echo $sql;
	}
	if(mysqli_query($con, $sql))
	{
		header('Location: updateSuccess.php');
	}

	

?>