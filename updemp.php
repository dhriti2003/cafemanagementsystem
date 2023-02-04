<?php
include('server.php');
include('conn.php');

error_reporting(0);
$ed = $_GET['ed'];
$en = $_GET['en'];
$eg = $_GET['eg'];
$es = $_GET['es'];
$ep = $_GET['ep'];
$brd = $_GET['brd'];
$epa = $_GET['epa'];
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
  	<td>Employee id</td>
  	<td><input type="text" value="<?php echo "$ed"?>" name="E_ID" required></td>
	</tr>
    <tr>
  	  <td> Employee name</td>
  	  <td><input type="text" value="<?php echo "$en"?>" name="E_NAME" required></td>
	</tr>
    <tr>
  	  <td>Gender</td>
  	  <td><input type="text" value="<?php echo "$eg"?>" name="E_GENDER"required></td>
	</tr>
    <tr>
  	  <td>Salary</td>
  	  <td><input type="text" value="<?php echo "$es"?>" name="E_SALARY"required></td>
	</tr>
    <tr>
  	  <td>Phone number</td>
  	  <td><input type="text" value="<?php echo "$ep"?>" name="E_PHONENUM"required></td>
	</tr>
    <tr>
  	  <td>Branch id</td>
  	  <td><input type="text" value="<?php echo "$brd"?>" name="BR_ID"required></td>
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
	$e_id = $_GET['E_ID'];
	$e_name = $_GET['E_NAME'];
	$e_gender = $_GET['E_GENDER'];
	$e_salary = $_GET['E_SALARY'];
    $e_phonenum = $_GET['E_PHONENUM'];
    $br_id= $_GET['BR_ID'];
	$e_pass = $_GET['E_PASS'];

	//UPDATE `employee` SET `E_ID`='[value-1]',`E_NAME`='[value-2]',`E_GENDER`='[value-3]',`E_SALARY`='[value-4]',`E_PHONENUM`='[value-5]',`BR_ID`='[value-6]',`E_PASS`='[value-7]' WHERE 1
    $query = " UPDATE `employee` SET `E_ID`='$e_id', `E_NAME`='$e_name', `E_GENDER`='$e_gender', `E_SALARY`='$e_salary', `E_PHONENUM`='$e_phonenum', `BR_ID`='$br_id',`E_PASS`='$e_pass' WHERE `E_ID`='$e_id'";
    $data=mysqli_query($conn,$query);

	if($data)
	{
		echo "<script>alert('Record Updated')</script>";
		?> 
		<meta http-equiv="Refresh" content="0 ;
		URL=http://localhost/index/table.php">
		<?php
	}
	else
	{
		echo "<font color='red'>Failed to update Record</font>";
	}
}
?>
