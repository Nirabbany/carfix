<?php 
session_start();
include_once("includes/config.php");
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
    if(isset($_POST['reqapp'])){
		$_SESSION['phone']=$_POST['phone'];
		$_SESSION['address']=$_POST['address'];
		$_SESSION['carenum']=$_POST['carenum'];
		$_SESSION['carlnum']=$_POST['carlnum'];
		$_SESSION['appointment']=$_POST['appointment'];
		
		$user_id = $_SESSION['id'];
		$address= mysqli_real_escape_string($con,$_POST['address']);
		$phone= mysqli_real_escape_string($con,$_POST['phone']);
		$carenum= mysqli_real_escape_string($con,$_POST['carenum']);
		$carlnum= mysqli_real_escape_string($con,$_POST['carlnum']);
		$appointment= mysqli_real_escape_string($con,$_POST['appointment']);

		$query="insert into orders(user_id,address,phone,carenum,carlnum,appointment) values('$user_id','$address','$phone','$carenum','$carlnum','$appointment')"; 

		$result = mysqli_query($con, $query);
	}

	if(isset($_POST['fixcar'])){
		$_SESSION['mec']=$_POST['mec'];		
		$mec = $_POST['mec'];
		$u_id = $_SESSION['id'];
		$appointment = $_SESSION['appointment'];

		$cnt= mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE user_id='$u_id' AND appointment= '$appointment' AND mechanic<>''"));
		if($cnt[0]>0){
			echo '<div class="prompterror">You already have an appointment on this day.</div>';
			$sql = "DELETE FROM orders WHERE user_id='$u_id' AND appointment='$appointment' AND mechanic=''";
			mysqli_query($con, $sql);
		}else{
			$query3= "UPDATE orders SET mechanic='$mec' WHERE user_id='$u_id' AND appointment='$appointment'";
			$result3 = mysqli_query($con, $query3);
			echo '<div class="promptsuccess">Appointment Recorded Successfully. <br />
      Please note that an admin can change the appointment date or the mechanic at any time. You will be notified in such cases.<br />
			<a href="index.php">Back To Home Page</a></div>';
		}
	}
  	 
$m1 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'maxwell' AND appointment='$appointment'"));
$m2 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'renshaw' AND appointment='$appointment'"));
$m3 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'david' AND appointment = '$appointment'"));
$m4 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'robert' AND appointment = '$appointment'"));
$m5 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'paul' AND appointment = '$appointment'"));

?>
<div class="bg">
<div class="container">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin-top:35px;">
	<label>Select a Mechanic</label>
	<select id="mec" name="mec" >
		<?php
        if($m1[0]==4){
        ?>
  		<option value="maxwell" disabled>Maxwell &nbsp;&nbsp;&nbsp;<?php echo 4-$m1[0]. ' slots remaining' 
  		?></option>
  		<?php
  		}else{
        ?>
        <option value="maxwell">Maxwell &nbsp;&nbsp;&nbsp;<?php echo 4-$m1[0]. ' slots remaining' ?></option>
        <?php
    	}
      	?>
  		<?php
        if($m2[0]==4){
        ?>
  		<option value="renshaw" disabled>Renshaw &nbsp;&nbsp;&nbsp;<?php echo 4-$m2[0]. ' slots remaining' 
  		?></option>
  		<?php
  		}else{
        ?>
        <option value="renshaw">Renshaw &nbsp;&nbsp;&nbsp;<?php echo 4-$m2[0]. ' slots remaining' ?></option>
        <?php
    	}
      	?>
      	<?php
        if($m3[0]==4){
        ?>
  		<option value="david" disabled>David &nbsp;&nbsp;&nbsp;<?php echo 4-$m3[0]. ' slots remaining' 
  		?></option>
  		<?php
  		}else{
        ?>
        <option value="david">David &nbsp;&nbsp;&nbsp;<?php echo 4-$m3[0]. ' slots remaining' ?></option>
        <?php
    	}
      	?>
      	<?php
        if($m4[0]==4){
        ?>
  		<option value="robert" disabled>Robert &nbsp;&nbsp;&nbsp;<?php echo 4-$m4[0]. ' slots remaining' 
  		?></option>
  		<?php
  		}else{
        ?>
        <option value="robert">Robert &nbsp;&nbsp;&nbsp;<?php echo 4-$m4[0]. ' slots remaining' ?></option>
        <?php
    	}
      	?>
      	<?php
        if($m5[0]==4){
        ?>
  		<option value="paul" disabled>Paul &nbsp;&nbsp;&nbsp;<?php echo 4-$m5[0]. ' slots remaining' 
  		?></option>
  		<?php
  		}else{
        ?>
        <option value="paul">Paul &nbsp;&nbsp;&nbsp;<?php echo 4-$m5[0]. ' slots remaining' ?></option>
        <?php
    	}
      	?>
	</select>
	<input type="submit" name="fixcar" value="Request for Appointment" />
</form>
</div>
</div>		
</body>
</html>