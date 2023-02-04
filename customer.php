<!DOCTYPE html>
<html>
<head>
	<title> display records OF CUSTOMER</title>
	<style> 
	body{
            background-color: #CAE9B6;
        }
        table {
    width: 100%; /* sets the table to take up the full width of its parent container */
    border-collapse: collapse; /* removes the default cell spacing */
}

th, td {
    border: 1px solid black; /* adds a border to the table cells */
    padding: 8px; /* adds some space inside the cells */
    text-align: left; /* aligns the text inside the cells to the left */
}

th {
    background-color: #f2f2f2; /* adds a light gray background color to the table headers */
    font-weight: bold; /* makes the text inside the headers bold */
}
	</style>
</head>
<body>
	<section>
		<h1 style="text-align:center">CUSTOMER DETAILS</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
		<tr>
		<th>CUSTOMER ID</th>
		<th>CUSTOMER NAME</th>
		<th>GENDER</th>
		<th>PHONE NUMBER</th>
		<th colspan="2" text-align="center">OPERATION</th> 
		</tr>
		<?php
		include ('conn.php');
		error_reporting(0);
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
		// SQL query to select data from database
		$query = " SELECT * FROM customer ORDER BY C_ID DESC ";
		$data = mysqli_query($conn, $query);
		$total = mysqli_num_rows($data); 
		if($total!=0)
		{
			while($result=mysqli_fetch_assoc($data))
			{
				echo "
				<tr>
				<td>". $result['C_ID']."</td>
				<td>". $result['C_NAME']."</td>
        		<td>". $result['C_GENDER']."</td>
				<td>". $result['C_PHONENUM']."</td>
				<td><a href= 'updcus.php? cd=$result[C_ID]&cn=$result[C_NAME]&cg=$result[C_GENDER]&cp=$result[C_PHONENUM]'><input type='submit' value='edit/update' id='editbtn'</a></td>
				<td><a href= 'delcus.php? cd=$result[C_ID]' onclick='return checkdelete()'>delete</a></td>
				</tr>
				";
			}
		}		
		else
		{
			echo"no records found";
		}
		?>
	
</table>
<script>
function checkdelete()
{
	 return Confirm('are you sure you want to delete this record');
}
</script>
	</section>
</body>
</html>