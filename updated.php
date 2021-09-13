<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Fix Your Car</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>

<?php

$eid = $_GET['id'];
include('includes/config.php');
if(isset($_POST['editapt'])){
	$mec = $_POST['mec'];
	$appointment = $_POST['appointment'];
	
	$query3= "UPDATE orders SET mechanic='$mec',appointment='$appointment',status=1 WHERE id='$eid'";
	$result3 = mysqli_query($con, $query3);

	echo '<div class="promptsuccess">Appointment has been updated. <a href="admin.php">Back To Admin Page</a></div>';
}
?>