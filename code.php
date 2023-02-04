<?php
session_start();
$con = mysqli_connect("localhost","root","","cms");

if(isset($_POST['save_multicheckbox']))
{
    $itemslist = $_POST['itemslist'];
    foreach($itemslist as $itemitems)
    {
        // echo $branditems."<br>";
        $query = "INSERT INTO contains (ITEM_NO) VALUES ('$itemitems')";
        $query_run = mysqli_query($con, $query);
    }

    if($query_run)
    {
        $_SESSION['status'] = "Inserted Successfully";
        header("Location: menu1.php");
    }
    else
    {
        $_SESSION['status'] = "Not Inserted";
        header("Location: menu1.php");
    }
}
?>