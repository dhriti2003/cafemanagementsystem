<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
  		<div class="header">
  			<h2>Register</h2>
  		</div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
    <div class="input-group">
  	  <label>Userid</label>
  	  <input type="text" name="userid" >
  	</div>
	  <label>Username</label>
  	  <input type="text" name="username" >
  	</div>
    <div class="input-group">
  	  <label>gender</label>
  	  <input type="text" name="gender">
    </div>
    <div class="input-group">
  	  <label>salary</label>
  	  <input type="text" name="salary">
  	</div>
    <div class="input-group">
  	  <label>phone_no</label>
  	  <input type="text" name="phonenum">
  	</div>
    <div class="input-group">
  	  <label>br_id</label>
  	  <input type="text" name="br_id">
  	</div>
  	<div class="input-group">   
  	  <label>Password</label>
  	  <input type="password" name="pass">
  	</div>
	  <div class="input-group">
      <label>Confirm Password</label> 
      <input type="password" name="cpass">
    </div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Login</a>
  	</p>
  </form>
	</div>
	<?php
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$user = mysqli_real_escape_string($conn, $_POST['userid']);
		$pass = mysqli_real_escape_string($conn, $_POST['pass']);
		$name = mysqli_real_escape_string($conn, $_POST['username']);
		$sal = mysqli_real_escape_string($conn, $_POST['salary']);
		$phone = mysqli_real_escape_string($conn, $_POST['phonenum']);
		$bid = mysqli_real_escape_string($conn, $_POST['br_id']);
		$gender = mysqli_real_escape_string($conn, $_POST['gender']);
		$cpass = mysqli_real_escape_string($conn, $_POST['cpass']);
	  
		$id = $_SESSION['userid'];
		if (isset($_REQUEST['pass'])) {
		  $sql = "SELECT `E_ID` FROM `employee` where `E_ID`=''" . $_REQUEST['E_ID'] . "";
		  $res = $conn->query($sql);
			if ($res->num_rows == 1) {
			  array_push($errors,"User already exist");
	  
			} else {
			  function isValidPassword($pass)
		  {
			$errors = [];
			  if ($_REQUEST['E_ID'] != "" || $_REQUEST['pass'] != "") {
				$user = $_REQUEST['userid'];
				$pass = $_REQUEST['pass'];
				$cpass = $_REQUEST['cpass'];
				$name = $_REQUEST['username'];
				$phone = $_REQUEST['phonenum'];
				if ($phone < 0) {
				  echo "<script>alert('Contact number cannot be negative account not created');</script>";
				}
				if (strlen($phone) != 10) {
				  echo "<script>alert('Contact number should be exactly 10 digits');</script>";
				}
				if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
				  echo "<script>alert('Name can be only text');</script>";
				}
				if (strlen($pass) < 8) {
				  echo "<script>alert('Password must be at least 8 characters long');</script>";
				}
	  
				if (!preg_match('/[a-z]/', $pass)) {
				  $errors[] = "Password must contain at least 1 lowercase letter";
				}
				if (!preg_match('/[A-Z]/', $pass)) {
				  $errors[] = "Password must contain at least 1 uppercase letter";
				}
				if (!preg_match('/[0-9]/', $pass)) {
				  $errors[] = "Password must contain at least 1 number";
				}
				if (preg_match('/\s/', $pass)) {
				  $errors[] = "Password cannot contain any spaces";
				}
				return $errors;
	  
			  }
			}
	  $errors = isValidPassword($pass);
	  if (count($errors) > 0) {
		echo "Password is invalid:<br>";
		foreach ($errors as $error) {
		  echo $error . "<br>";
		}
	  } else {
		echo "Password is valid";
	  }
		  }
			  // form validation: ensure that the form is correctly filled ...
		  // by adding (array_push()) corresponding error unto $errors array
		  if (empty($user)) {
			array_push($errors, "Userid is required");
		  }
		  if (empty($pass)) {
			array_push($errors, "Password is required");
		  }
		  if (empty($name)) {
			array_push($errors, "Username is required");
		  }
	  
	  
		  // first check the database to make sure 
		  // a user does not already exist with the same username and/or email
		  $user_check_query = "SELECT * FROM `employee` WHERE `E_ID`='$user'";
		  $result = mysqli_query($conn, $user_check_query);
		  $employee = mysqli_fetch_assoc($result);
	  
		  if ($employee) { // if user exists
			if ($employee['E_ID'] === $user) {
			  array_push($errors,"Userid already exists");
			}
	  
		  }
	  
		  // Finally, register user if there are no errors in the form
		  //if (count($errors) == 0) {
			//$pass = md5($pass); //encrypt the password before saving in the database
	  
			$query = "INSERT INTO EMPLOYEE (E_ID, E_PASS,E_NAME,E_SALARY,E_PHONENUM,E_GENDER,BR_ID) 
					  VALUES('$user', '$pass','$name','$sal','$phone','$gender','$bid')";
			mysqli_query($conn, $query);
			$_SESSION['userid'] = $user;
			$_SESSION['success'] = "You are now logged in";
			header('location: login.php');
		  }
		}
	?>
</body>
</html>