<?php
 session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login1.css">
</head>
<body>
<div class="container">
        <h1>Login</h1>
        <form action="" method="post">
            <p>Userid</p>
            <input type="text" id="username" name="userid" placeholder="enter the username">
            <p>password</p>
            <input type="password" name="pass" id="password" placeholder="Enter the password">
            <input type="submit" value="login">
            <a href="register.php">create new account?</a>
        </form>

        
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name="cms";

$conn = new mysqli($servername, $username, $password,$db_name);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
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

if(isset($_POST['pass'])){

$user = $_POST["userid"];
$pass = $_POST["pass"];


$sql = "SELECT * FROM EMPLOYEE WHERE E_ID='$user' AND E_PASS='$pass'";
$result = $conn->query($sql);

// if ($result->num_rows > 0) {
    
//     session_start();
//     $_SESSION["logged_in"] = true;
//     $_SESSION["userid"] = $user;
//     header("Location: manager.html");
// } else {
    
//     echo
//              "
//              <script>
//                alert('Invalid Username or Password');
//              </script>
//              ";
// }
$stmt = $conn->prepare("SELECT * FROM EMPLOYEE WHERE E_ID=? AND E_PASS=?");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

$stmt2 = $conn->prepare("SELECT * FROM EMPLOYEE E, BRANCH B WHERE E_ID=? AND E_PASS=? AND E.E_ID=B.BR_MANAGER");
$stmt2->bind_param("ss", $user, $pass);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result->num_rows > 0) {
    session_start();
    $_SESSION["logged_in"] = true;
    $_SESSION["userid"] = $user;
    if ($result2->num_rows > 0) {
        header("Location: manager.html");
    } else{
        header("Location: custlogin.php");
    }
    
} else {
    echo "
    <script>
        alert('Invalid Username or Password');
    </script>
    ";
}


$conn->close();
}
?>
</body>
</html>