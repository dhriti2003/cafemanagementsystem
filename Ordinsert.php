<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
      body{
  background-image: linear-gradient(to right, #544c28, #6f8234);
}
h2 {
  font-size: 2em;
  color:  rgb(40, 152, 17);
}
input[type="text"], input[type="password"] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
}
input[type="submit"] {
          width: 100%;
          background-color: rgb(40, 152, 17);
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          border-radius: 4px;
          cursor: pointer;
}
.container {
          width: 300px;
          background-color: #f2f2f2;
          padding: 20px;
          position: relative;
          top:100px;
          left:500px;
}
    </style>
</head>
<body>
<?php


?>
<div class="container">
  		<div class="header">
  			<h2>Order Details</h2>
  		</div>
	
  <form method="post" action="Ordinsert.php">
  	<?php 
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name="cms";
    
    $conn = mysqli_connect($servername, $username, $password, $db_name);
    
    if($conn){
        echo " <br>";
    }else{
        die("Connection was unsuccesful: " . mysqli_connect_error());
    }?>
    <?php 
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
        $_SESSION['success'] = "You are now logged in";
        header('location: menu.php');
      }
     $sql = "SELECT MAX(ORDER_NO) as max_value FROM `orders`";
     $result = mysqli_query($conn, $sql);
     $row = mysqli_fetch_assoc($result);
     $custid = $_SESSION['c_id'];
     $empid = $_SESSION['userid'];
    //  if (mysqli_num_rows($result) > 0) {
    //      // Output data of the row
    //      $row = mysqli_fetch_assoc($result);
    //      echo "<input type='text' value='" . ($row["max_value"] + 1) . "'>";
    //  }
    ?>
    <div class="input-group"> 
  	  <label>Order id</label>
  	  <?php echo "<input type='text' name='ord_id' value='". ($row["max_value"] + 1) . "'>"?>
  	</div>
    <div class="input-group">
  	  <label>Date</label>
  	  <input type="date" name="date" >
  	</div>
    <br>
    <div class="input-group">
  	  <label>Employee ID</label>
  	  <?php echo "<input type='text' name='empid' value='".($empid)."'>"?>
    </div>
    <div class="input-group">
  	  <label>Customer ID</label>
      <?php echo "<input type='text' name='custid' value='".($custid)."'>"?>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="ord_user">Submit</button>
  	</div>
  </form>
	</div>
  <!-- <?php
  $ord_id = $_POST['ord_id'];
  $SESSION['ord_id'] = $ord_id;
  ?> -->
   
</body>
</html>