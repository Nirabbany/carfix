<?php
session_start();
require_once('includes/config.php');

$edit_record = $_GET['id'];
$appointment= $_GET['d'];

$m1 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'maxwell' AND appointment='$appointment'"));
$m2 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'renshaw' AND appointment='$appointment'"));
$m3 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'david' AND appointment = '$appointment'"));
$m4 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'robert' AND appointment = '$appointment'"));
$m5 = mysqli_fetch_row(mysqli_query($con,"Select COUNT(*) FROM orders WHERE mechanic = 'paul' AND appointment = '$appointment'"));
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Appointment</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
<div class="container">
<form method="post" action="updated.php?id=<?php echo $edit_record; ?>" style="margin-top:35px;">
	<label>Change Appointment Date</label>
	<input type="date" name="appointment" placeholder="Date" value ="<?php echo $appointment;?>"><br />
	<label>Select a Mechanic</label>
	<select name="mec" >
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
	<input type="submit" name="editapt" value="Save Change" />
</form>
</div>
</body>
</html>	