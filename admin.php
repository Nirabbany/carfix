<?php
session_start();
if(!$_SESSION['code']){
header('location:index.php?error=You must be an Admin to view this page...!');
}
require_once('includes/config.php');
 
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Admin's Page</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<h3 class="semi-title">Welcome <?php echo $_SESSION['name']; ?>, <a href="logout.php">Log Out</a></h3>
<table>
<tr>
<td>
<h1>Appointment List</h1>
</td>
</tr>
 
<tr>
<th>Client Name</th>
<th>Phone</th>
<th>Car Registration Number</th>
<th>Appointment Date</th>
<th>Mechanic Name</th>
<th>Edit</th>
</tr>
 
<tr>
 
<?php
  
$sql = mysqli_query($con,"SELECT name,phone,carlnum,appointment,mechanic,orders.id FROM users JOIN orders 
  WHERE users.id = orders.user_id");
 
while($row = mysqli_fetch_array($sql,MYSQLI_BOTH)){
  $name = $row['name'];
  $phone = $row['phone'];
  $car_reg_no = $row['carlnum'];
  $apt_date = $row['appointment'];
  $_SESSION['appointment'] = $apt_date;
  $mechanic = $row['mechanic'];
  $_SESSION['mec'] = $mechanic;
  $id = $row['id'];
 
?>
<td><?php echo $name; ?></td> 
<td><?php echo $phone; ?></td>  
<td><?php echo $car_reg_no; ?></td> 
<td><?php echo $apt_date; ?></td>  
<td><?php echo $mechanic; ?></td>  
<td><a href='edit.php?id=<?php echo $id; ?>&d=<?php echo $apt_date; ?>'>Edit</a></td>
</tr>
 
<?php } ?>
 
</table>

</body>
</html>