<!DOCTYPE html>
<html>
<head>
	<title> display records OF EMPLOYEES</title>
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
		<h1 style="text-align:center">EMPLOYEE DETAILS</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
		<tr>
		<th>EMPLOYEE ID</th>
		<th>EMPLOYEE NAME</th>
		<th>GENDER</th>
		<th>SALARY</th>
		<th>PHONE NUMBER</th>
		<th>BRANCH ID</th>
		<th colspan="2" text-align="center">OPERATION</th> 
		</tr>
		<?php
		include ('conn.php');
		error_reporting(0);
		// SQL query to select data from database
		$query = " SELECT * FROM employee ORDER BY E_ID DESC ";
		$data = mysqli_query($conn, $query);
		$total = mysqli_num_rows($data); 
		if($total!=0)
		{
			while($result=mysqli_fetch_assoc($data))
			{
				echo "
				<tr>
				<td>". $result['E_ID']."</td>
				<td>". $result['E_NAME']."</td>
        		<td>". $result['E_GENDER']."</td>
				<td>". $result['E_SALARY']."</td>
				<td>". $result['E_PHONENUM']."</td>
				<td>". $result['BR_ID']."</td>
				<td><a href= 'updemp.php? ed=$result[E_ID]&en=$result[E_NAME]&eg=$result[E_GENDER]&es=$result[E_SALARY]&ep=$result[E_PHONENUM]&brd=$result[BR_ID]'><input type='submit' value='edit/update' id='editbtn'</a></td>
				<td><a href= 'delemp.php? ed=$result[E_ID]' onclick='return checkdelete()'>delete</a></td>
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