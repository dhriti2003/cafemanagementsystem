<?php
include('conn.php');
error_reporting(0);
$order_no = $_GET['on'];
$query = "DELETE FROM `orders` WHERE `ORDER_NO`='$order_no'";
$data = mysqli_query($conn, $query);
if($data)
{
    echo "<script>alert('Record deleted from database')</script>";
    ?>
    <meta http-equiv="Refresh" content="0; URL= http://localhost/index/orders.php ">
    <?php
}
else
{
    echo "<font color='red'>Failed to delete Record from Database";
}
?>
