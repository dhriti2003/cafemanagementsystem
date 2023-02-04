<?php
include('server.php');
include('conn.php');

error_reporting(0);
$cd = $_GET['cd'];
$cn = $_GET['cn'];
$cg = $_GET['cg'];
$cp = $_GET['cp'];
?>
<html>
<head>
  <title>Update system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
  		<div class="header">
  			<h2>update</h2>
  		</div>
  <form method="GET" action="">
	<table>
  	<?php include('errors.php'); ?>
      <tr>
  	<td>Email id</td>
  	<td><input type="text" value="<?php echo "$cd"?>" name="id" required></td>
	</tr>
	<tr>
  	<td>Customer name</td>
  	<td><input type="text" value="<?php echo "$cn"?>" name="name" required></td>
	</tr>
    <tr>
  	  <td>Gender</td>
  	  <td><input type="text" value="<?php echo "$cg"?>" name="gender" required></td>
	</tr>
    <tr>
  	  <td>phone number</td>
  	  <td><input type="text" value="<?php echo "$cp"?>" name="phone"required></td>
	</tr>
  	<tr>
  	<td colspan="2"><input type="submit" id="button" name="submit" value="update"></a></td>
	</tr>
  </form>
	</div>
</body>
</html>
<?php
if($_GET['submit'])
{
	$c_id = $_GET['id'];
	$c_name = $_GET['name'];
	$c_gender = $_GET['gender'];
	$c_phonenum = $_GET['phone'];
	//UPDATE `orders` SET `ORDER_NO`='[value-1]',`ORD_DATE`='[value-2]',`E_ID`='[value-3]',`C_ID`='[value-4]' WHERE 1
	$query="UPDATE `customer` SET `C_ID`='$c_id', `C_NAME`='$c_name', `C_GENDER`='$c_gender',`C_PHONENUM`='$c_phonenum' WHERE `C_ID`='$c_id'";
	$data=mysqli_query($conn,$query);

	if($data)
	{
		echo "<script>alert('Record Updated')</script>";
		?> 
		<meta http-equiv="Refresh" content="0 ;
		URL=http://localhost/index/customer.php">
		<?php
	}
	else
	{
		echo "<font color='red'>Failed to update Record</font>";
	}
}
?>