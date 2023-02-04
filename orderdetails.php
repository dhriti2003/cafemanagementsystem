<?php
include('conn.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$empid = $_SESSION['userid'];

?>
<div class="container">
  		<div class="header">
  			<h2>Order Details</h2>
  		</div>
	
  <form method="post" action="custlogin.php">
  	<?php include('errors.php'); ?>
    <!-- <div class="input-group">
  	  <label>Customer id</label>
  	  <input type="text" name="c_id" >
  	</div> -->
    <div class="input-group">
  	  <label>Date</label>
  	  <input type="date" name="date" >
  	</div>
    <div class="input-group">
  	  <label>Employee ID</label>
  	  <input type="text" name="empid">
    </div>
    <div class="input-group">
  	  <label>Customer ID</label>
  	  <input type="text" name="custid" >
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="sub">Submit</button>
  	</div>
    <br><a href="menu.php">If customer details already exist, click here</a>
  </form>
	</div>
   
</body>
</html>