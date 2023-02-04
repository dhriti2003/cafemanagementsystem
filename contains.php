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
        body{
            background-color: #CAE9B6;
        }
        table {
    border-collapse: collapse; /* removes the default cell spacing */
    width: 60%;
    margin-left: auto;
    margin-right: auto;
    
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
.logout-button {
        position: fixed;
        bottom: 10%;
        right: 5%;
        text-align: center;
        margin-top: 20px;
        }   

        .logout-button a {
        padding: 10px 20px;
        background-color: green;
        color: white;
        text-decoration: none;
        }
    </style>
    
</head>
<body>
    <h1 style="text-align:center">ORDERED ITEMS</h1>
    <table>
        <thead>
            <tr>
                <th>ORDER NUMBER</th>
                <th>ITEM NUMBER</th>
                <th>QUANTITY</th>
            </tr>
           
        </thead>
        <tbody>
            <?php
            include('conn.php');

            //$ordno = $_SESSION['ord_id'];
            $sql = "SELECT * FROM `contains`";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                <td>".$row['ORDER_NO']."</td>
                <td>".$row['ITEM_NO']."</td>
                <td>".$row['QUANTITY']."</td>
            </tr>";
                
            }

            
            ?>
        </tbody>
    </table>
    <div class="logout-button">
        <a href="final.php">Place Order</a>
  </div>
</body>
</html>