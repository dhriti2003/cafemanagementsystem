<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="employee.css">
    <title>hello</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</head>
<body>

    <div class="full-page">
        <div class="navbar">
            <div>
                <a href='website.html'>Coffee Shop</a>
            </div>
            
            <nav>
                <ul id='MenuItems'>
                    <li><a href='#'>Home</a></li>
                    <li><a href='#'>About Us</a></li>
                    <li><a href='#'>Menu</a></li>
                    <li><a href='#'>Customer</a></li>
                    <li><a href='#'>Orders</a></li>
                    <li><button class='loginbtn' onclick="document.getElementById('login-           form').style.display='block'" style="width:auto;">Login</button></li>
                </ul>
            </nav>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">

                <?php  
                if(isset($_SESSION['status']))
                {
                    echo "<h4>".$_SESSION['status']."</h4>";
                    unset($_SESSION['status']);
                }
                ?>
                <div class="container">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>MENU ITEMS</h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">
                        <?php
                            $con = mysqli_connect("localhost","root","","cms");

                            $item_query = "SELECT * FROM items";
                            $query_run = mysqli_query($con, $item_query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $item)
                                {
                                    ?>
                                    <input type="checkbox" name="itemslist[]" value="<?= $item['ITEM_NAME']; ?>" /> <?= $item['ITEM_NAME']; ?> <br/>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "No Record Found";
                            }
                        ?>
                            <div class="form-group mt-3">
                                <button name="save_multicheckbox" class="btn btn-primary">Save Multiple Checkbox</button>
                            </div>
                        </form>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
            
        </div>
    </div>
    
</body>

    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>