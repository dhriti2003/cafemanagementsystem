<?php
include('conn.php');
error_reporting(0);
$c_id = $_GET['cd'];
$query = "DELETE FROM `customer` WHERE `C_ID`='$c_id'";
$data = mysqli_query($conn, $query);
if($data)
{
    echo "<script>alert('Record deleted from database')</script>";
    ?>
    <meta http-equiv="Refresh" content="0; URL= http://localhost/index/customer.php ">
    <?php
}
else
{
    echo "<font color='red'>Failed to delete Record from Database";
}
?>