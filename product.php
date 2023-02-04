<!DOCTYPE html>
<html>
<body>

<?php
session_start();

// initializing variables
$username = "E_NAME";
$userid    = "E_ID";
$gender = "E_GENDER";
$salary = "E_SALARY";
$phonenum = "E_PHONENUM";
$br_id = "BR_ID";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'cms');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}



$sql = "SELECT * FROM EMPLOYEE";
$result = $db->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        print "<br> - NAME: ". $row["E_NAME"]. "<br> - userid: ". $row["E_ID"]. "<br> - salary: ". $row["E_SALARY"]."<br> - phone_no: ". $row["E_PHONENUM"]."<br> - gender: ". $row["E_GENDER"]."<br> - br_id: ". $row["BR_ID"]."<br> - PASS: " . $row["E_PASS"] . "<br>";
      print "<img src=\"".$row["img"]."\">";
     
    }
} else {
    print "0 results";
}



$db->close();   
        ?> 



</body>
</html>