<!-- <?php
session_start();
?> -->
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
    width: 60%; /* sets the table to take up the full width of its parent container */
    float: left;
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
.container{
    background-color: transparent;
    padding-left: 2%;
    padding-bottom: 2%;
    position: fixed;
    right: 2%;
    width: 30%;
    float: right;
}
input[type="text"], input[type="number"] {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        }


    </style>
    
</head>
<body>
    <h1 style="text-align:center">MENU</h1>
    <table>
        <thead>
            <tr>
                <th>Item number</th>
                <th>Item name</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
           
        </thead>
        <tbody>
            <?php
            include('conn.php');

            $sql = "SELECT * FROM `items`";
            $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                <td>".$row['ITEM_NO']."</td>
                <td>".$row['ITEM_NAME']."</td>
                <td>".$row['ITEM_COST']."</td>
                <td>".$row['ITEM_DESCRIPTION']."</td>
            </tr>";
                
            }

            
            ?>
        </tbody>
    <!-- <?php
    $ordernum = $_SESSION['ord_id'];
    ?> -->
    </table>
    <div class="container">
        <h1>Add items</h1>
        <form action="" method="post">
            <p>Order number</p>
            <input type="text" id="orderno" name="ordernum" placeholder="Enter Order number">
            <!-- <?php echo "<input type='text' name='ordernum' value='".($ordernum)."'>"?> -->
            <p>Item number</p>
            <input type="text" id="itemno" name="itemnum" placeholder="Enter Item">
            <p>Quantity</p>
            <input type="number" name="qty" id="qty" placeholder="Select quantity">
  	        <input type="submit" name="menu_add" value="Add"><br>
            <a href="contains.php">Go to orders </a>
        </form>
    </div>
    <?php
    include('conn.php');
    if (isset($_POST['menu_add'])) {
        // receive all input values from the form
        $ordernum = mysqli_real_escape_string($conn, $_POST['ordernum']);
        $itemnum = mysqli_real_escape_string($conn, $_POST['itemnum']);
        $qty = mysqli_real_escape_string($conn, $_POST['qty']);
    
        try {
            $query = "INSERT INTO `contains`(`ORDER_NO`,`ITEM_NO`,`QUANTITY`)  VALUES ('$ordernum','$itemnum','$qty')";
            if (!mysqli_query($conn, $query)) {
                throw new mysqli_sql_exception(mysqli_error($conn));
            }
            echo "<script>alert('Item added successfully');</script>";
        } catch (mysqli_sql_exception $e) {
            echo '<script type="text/javascript">alert(" '.$e->getMessage().'");</script>';
        }
        
    }
    ?>
</body>
</html>