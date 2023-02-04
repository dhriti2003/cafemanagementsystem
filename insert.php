<?php

include 'conn.php';

if(isset($_POST['done'])){

 $on = $_POST['ORDER_NO'];
 $od = $_POST['ORDER_DATE'];
 $ed = $_POST['E_ID'];
 $cd = $_POST['C_ID'];
 $q = "INSERT INTO 'orders' ('ORDER_NO', 'ORDER_DATE','E_ID','C_ID') VALUES ( '$on', '$od', '$ed', '$cd' )";

 $query = mysqli_query($conn,$q);
}
?>

<!DOCTYPE html>
<html>
<head>
 <title></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

 <div class="col-lg-6 m-auto">
 
 <form method="post">
 
 <br><br><div class="card">
 
 <div class="card-header bg-dark">
 <h1 class="text-white text-center">  Insert Operation </h1>
 </div><br>

 <label> Order number </label>
 <input type="text" name="ORDER_NO" class="form-control"> <br>

 <label> Order date </label>
 <input type="date" name="ORDER_DATE" class="form-control"> <br>

 <label> Emp id </label>
 <input type="text" name="E_ID" class="form-control"> <br>

 <label> Cust id </label>
 <input type="text" name="C_ID" class="form-control"> <br>


 <button class="btn btn-success" type="submit" name="done"> Submit </button><br>

 </div>
 </form>
 </div>
</body>
</html>