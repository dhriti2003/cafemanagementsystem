<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="third.css">
</head>
<body>
<a href="\login\first.html"><button class="btn btn1">back</button></a>
    <div class="center">
        <h1>Manager Login</h1>
        <form action="" method="post">
            <div class="txt_field">
                <p><strong>Manager_id:</strong></p>
                <input type="text" id="BR_MANANGER" name="BR_MANANGER" placeholder="Enter the manager id">
            </div>
            <div class="txt_field">
                <p><strong>Password:</strong></p>
                <input type="password" name="password" id="password" placeholder="Enter the password">
            </div>
            <input type="submit" value="LOGIN"> 
        </form>
    </div>

</body>

</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "cms";

$conn = new mysqli($servername, $username, $password, $db_name);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
  if (isset($_POST['password'])) {

    $user = $_POST["BR_MANAGER"];
    $pass = $_POST["password"];
 
    if ($user == '1') {
      $sql = "SELECT * FROM `branch` WHERE `BR_MANAGER`='$user' AND M_PASS='$pass'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        session_start();
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $user;
        header("Location: manager.html");
      } else {
    
        echo
          "
            <script>
              alert('Invalid Username or Password');
            </script>
             ";
      }
    } else {
    
      echo
        "
          <script>
            alert('Invalid Username or Password');
          </script>
           ";
    }
    
  
}
?>


<!DOCTYPE html>
<html lang="en">
<body>
    <div class="center1">
        <h1>Employee Login</h1>
        <form method="post">
            <div class="txt_field">
                <p><strong>Username_id:</strong></p>
                <input type="text" id="BR_ID" name="BR_ID" placeholder="Enter the department id">
            </div>
            <div class="txt_field">
                <p><strong>Password:</strong></p>
                <input type="password" name="password" id="password" placeholder="Enter the password">
            </div>
            <input type="submit" value="LOGIN"> 
        </form>
    </div>
</body>
</html>
<?php

if (isset($_POST['password'])) {
  $user = $_POST["BR_ID"];
  $pass = $_POST["password"];
  if ($user == '1') {
    $sql = "SELECT * FROM employee WHERE E_ID='$user' AND E_PASS='$pass'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
  
      session_start();
      $_SESSION["logged_in"] = true;
      $_SESSION["username"] = $user;
      header("Location: menu.php");
    }
    else {
     
      echo
        "
          <script>
            alert('Invalid Username or Password');
          </script>
           ";
    } 

  }          
 

  $conn->close();
}
?>