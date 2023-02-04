<?php
session_start();
?>
<?php
include ('conn.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
  		<div class="header">
  			<h2>Customer Details</h2>
  		</div>
	
  <form method="post" action="custlogin.php">
  	<?php include('errors.php'); ?>
    <div class="input-group">
  	  <label>Customer id</label>
  	  <input type="text" name="c_id" >
  	</div>
  	<div class="input-group">
  	  <label>Customer name</label>
  	  <input type="text" name="name" >
  	</div>
    <div class="input-group">
  	  <label>Gender</label>
  	  <input type="text" name="gender" >
  	</div>
    <div class="input-group">
  	  <label>Phone number</label>
  	  <input type="number" name="phonenum">
    </div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="cust_user">Submit</button>
  	</div>
    <br><a href="Ordinsert.php">If customer details already exist, click here</a>
  </form>
	</div>
	<?php
	// $sql = "SELECT `C_ID` FROM `customer` where `C_ID`=''" . $_REQUEST['C_ID'] . "";
	// $res = $conn->query($sql);
	// if ($res->num_rows == 1) {
	// 	array_push($errors, "Customer already exist");
	// }
	// $user_check_query = "SELECT * FROM `customer` WHERE `C_ID`='$c_id'";
	// $result = mysqli_query($conn, $user_check_query);
	// $employee = mysqli_fetch_assoc($result);

	// if ($employee) { // if user exists
	//   if ($employee['E_ID'] === $user) {
	// 	array_push($errors,"Userid already exists");
	//   }

	// }
	if (isset($_POST['cust_user'])) {
		// receive all input values from the form
		$c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
		if (empty($c_id)) {
		  echo "<script>alert('Email field cannot be left blank');</script>";
		} else if (!filter_var($c_id, FILTER_VALIDATE_EMAIL)) {
		  echo "<script>alert('Invalid email format');</script>";
		}
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		if (empty($name)) {
		  echo "<script>alert('Name field cannot be left blank');</script>";
		}
		$gender = mysqli_real_escape_string($conn, $_POST['gender']);
		if (empty($gender)) {
		  echo "<script>alert('Gender field cannot be left blank');</script>";
		}
		$phonenum = mysqli_real_escape_string($conn, $_POST['phonenum']);
		if (empty($phonenum)) {
		  echo "<script>alert('Phone number field cannot be left blank');</script>";
		} else if (!preg_match("/^\d{10}$/", $phonenum)) {
		  echo "<script>alert('Invalid phone number format');</script>";
		} else {
			// $c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
			$user_check_query = "SELECT * FROM `customer` WHERE `C_ID`='$c_id'";
			$result = mysqli_query($conn, $user_check_query);
			$custom = mysqli_fetch_assoc($result);

			if ($custom) { // if user exists
	  			if ($custom['C_ID'] === $c_id) {
					array_push($errors,"Customer already exists");
	  			}

			}
			else{
				 // Insert the values into the database
				 $sql = " INSERT INTO `customer`(`C_ID`, `C_NAME`, `C_GENDER`, `C_PHONENUM`) VALUES ('$c_id','$name','$gender','$phonenum')";
				 $result = mysqli_query($conn, $sql);
			   //   if ($result) {
			   // 	$_SESSION["c_id"] == $c_id;
			   // 	echo "<script>alert('Record added successfully');</script>";
			   // 	header('location:Ordinsert.php');
			   //   } else {
			   // 	echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($conn) . "');</script>";
			   //   }
			   	$_SESSION['c_id'] = $c_id;
				 $_SESSION['success'] = "You are now logged in";
				 header('location: Ordinsert.php');
			   }

			}
		 
	  }
	
	?>
</body>
</html>