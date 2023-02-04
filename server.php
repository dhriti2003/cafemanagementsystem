<?php


// initializing variables
$user = "userid";
$pass    = "pass";
$errors = array(); 

// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'cms');

// REGISTER USER
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
      header('location: index.php');
    }
  }



// LOGIN USER
if (isset($_POST['login_user'])) {
  $user = mysqli_real_escape_string($conn, $_POST['userid']);
  $pass = mysqli_real_escape_string($conn, $_POST['pass']);

  if (empty($user)) {
  	array_push($errors, "Username is required");
  }
  if (empty($pass)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$pass = md5($pass);
  	$query = "SELECT * FROM EMPLOYEE WHERE E_ID='$user' AND E_PASS='$pass'";
  	$results = mysqli_query($conn, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['userid'] = $user;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: login.php');
  	}else {
  		echo "<script>alert('Wrong username/password combination');</script>";
  	}
  }
}

//custlogin

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
    // Insert the values into the database
    $sql = " INSERT INTO `customer`(`C_ID`, `C_NAME`, `C_GENDER`, `C_PHONENUM`) VALUES ('$c_id','$name','$gender','$phonenum')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $_SESSION["c_id"] == $c_id;
      echo "<script>alert('Record added successfully');</script>";
      header('location:Ordinsert.php');
    } else {
      echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($conn) . "');</script>";
    }
  }
}



  

//order insert
if (isset($_POST['ord_user'])) {
  // receive all input values from the form
  // $c_id = mysqli_real_escape_string($db, $_POST['c_id']);
  $ord_id = mysqli_real_escape_string($conn, $_POST['ord_id']);
  $date = mysqli_real_escape_string($conn, $_POST['date']);
  $e_id = mysqli_real_escape_string($conn, $_POST['empid']);
  $c_id = mysqli_real_escape_string($conn, $_POST['custid']);

  $user_check_query = "SELECT * FROM ORDERS WHERE ORDER_NO='$ord_id'";
  $result = mysqli_query($conn, $user_check_query);
  $orders = mysqli_fetch_assoc($result);
  
  if ($orders) { // if user exists
    if ($orders['ORDER_NO'] === $ord_id) {
      echo "<script>alert('ORDER_NO already exists');</script>";
    }

  }

  

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  // if (empty($c_id)) { array_push($errors, "Userid is required"); }
  //if (empty($name)) {
    // array_push($errors, "Username is required"); 
    //}
 

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  
 

  // Finally, register user if there are no errors in the form
  //if (count($errors) == 0) {
  	//$pass = md5($pass);//encrypt the password before saving in the database
    $c_id = $_SESSION['c_id'];
  	$query = "INSERT INTO `orders` (`ORDER_NO`,`ORD_DATE`,`E_ID`,`C_ID`)
  			  VALUES('$ord_id','$date','$e_id','$c_id')";
  	mysqli_query($conn, $query);
  	 $_SESSION['c_id'] = $c_id;
  	 $_SESSION['success'] = "You are now logged in";
  	header('location: menu.php');
  }


?>

