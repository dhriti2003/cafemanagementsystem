<?php
include('conn.php');
error_reporting(0);
$e_id = $_GET['ed'];
$query = "DELETE FROM `employee` WHERE `E_ID`='$e_id'";
$data = mysqli_query($conn, $query);
if($data)
{
    echo "<script>alert('Record deleted from database')</script>";
    ?>
    <meta http-equiv="Refresh" content="0; URL= http://localhost/index/table.php ">
    <?php
}
else
{
    echo "<font color='red'>Failed to delete Record from Database";
}
?>