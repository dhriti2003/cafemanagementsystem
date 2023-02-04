<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .total-price {
        text-align: center;
        margin: 50px 0;
        }

        .total-price h2 {
        font-size: 36px;
        color: #333;
        font-weight: bold;
        }
        body{
            background-color:  #CAE9B6;
        }
        .container{
        background-color: white;
        padding: 2%;
        margin: 0 auto;
        width: 30%;
        left: 33%;
        top: 20%;
        text-align: center;
        border: 3px solid green;
        position: fixed;
       }
       /* .logout-button {
        position: fixed;
        bottom: 10%;
        left: 41%;
        text-align: center;
        margin-top: 20px;
        }   

        .logout-button a {
        padding: 10px 20px;
        background-color: green;
        color: white;
        text-decoration: none;
        }
        .button {
        position: fixed;
        bottom: 10%;
        right: 39%;
        text-align: center;
        margin-top: 20px;
        }
        .button a{
        padding: 10px 20px;
        background-color: green;
        color: white;
        text-decoration: none;    
        } */
        .logout-button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
        position: fixed;
        bottom: 10%;
        left: 38%;
    }
    .nextorder-button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
        position: fixed;
        bottom: 10%;
        right: 35%;
    }
        
    </style>
</head>
<body>
    <?php
    include('conn.php');

    //$order_number = $_SESSION['ord_id'];
    $sql = "SELECT SUM(contains.QUANTITY * items.ITEM_COST) as 'Total Price'
            FROM contains
            JOIN items ON contains.ITEM_NO = items.ITEM_NO
            WHERE ORDER_NO IN (SELECT MAX(ORDER_NO) FROM contains)";
            //WHERE contains.ORDER_NO = $order_number ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    ?>
    <div class="container">
        <h2>Your order has been placed!</h2>
        <h2>Your total is <?php echo $row["Total Price"];?> rupees</h2>
        <h3>Please do visit again!</h3>
    </div>
    <form>
        <input class="logout-button" type="submit" name="logout" value="Logout">
    </form>
    <form>
        <input class="nextorder-button" type="submit" name="nextorder" value="Take another order">
    </form>

    <?php
    if(isset($_GET['logout'])){
        unset($_SESSION['userid']);
        unset($_SESSION['c_id']);
        unset($_SESSION['ord_id']);
        session_destroy();
        header('Location:login.php');
        exit;
    }
    if(isset($_GET['nextorder'])){
        unset($_SESSION['c_id']);
        unset($_SESSION['ord_id']);
        header('Location:custlogin.php');
        exit;
    }
    ?>

</body>
</html>