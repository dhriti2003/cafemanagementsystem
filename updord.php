<?php
include('server.php');
include('conn.php');

error_reporting(0);
$on = $_GET['on'];
$od = $_GET['od'];
$ed = $_GET['ed'];
$cd = $_GET['cd'];
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
  	<td>Order number</td>
  	<td><input type="text" value="<?php echo "$on"?>" name="ORDER_NO" required></td>
	</tr>
    <tr>
  	  <td> order date</td>
  	  <td><input type="date" value="<?php echo "$od"?>" name="ORDER_DATE" required></td>
	</tr>
    <tr>
  	  <td>E_ID</td>
  	  <td><input type="text" value="<?php echo "$ed"?>" name="E_ID"required></td>
	</tr>
    <tr>
  	  <td>C_ID</td>
  	  <td><input type="text" value="<?php echo "$cd"?>" name="C_ID"required></td>
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
	$order_no = $_GET['ORDER_NO'];
	$order_date = $_GET['ORDER_DATE'];
	$e_id = $_GET['E_ID'];
	$c_id = $_GET['C_ID'];
	//UPDATE `orders` SET `ORDER_NO`='[value-1]',`ORD_DATE`='[value-2]',`E_ID`='[value-3]',`C_ID`='[value-4]' WHERE 1
	$query="UPDATE `orders` SET `ORD_DATE`='$order_date', `E_ID`='$e_id', `C_ID`='$c_id' WHERE `ORDER_NO`='$order_no'";
	$data=mysqli_query($conn,$query);

	if($data)
	{ 
		echo "<script>alert('Record Updated')</script>";
		?> 
		<meta http-equiv="Refresh" content="0 ;
		URL=http://localhost/index/orders.php">
		<?php
	}
	else
	{
		echo "<font color='red'>Failed to update Record</font>";
	}
}
?>