<?php   
        include ('../admin/secure/log.php');
        include ('bits/login_check.php');

?>


<html>
    <head>
        <title> Food Order Website - Home-Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <!-- Menu section start-->

        <div class="menu text-center ">
            <div class="wrapper">
                <ul>
                    <li><a href="<?php echo SITEURL?>" class="myButton">Front Page</a></li>
                    <li><a href="index.php" class="myButton">Home</a></li>
                    <li><a href="manage.admin.php" class="myButton">Admin</a></li>
                    <li><a href="manage.category.php" class="myButton">Category</a></li>
                    <li><a href="manage.food.php" class="myButton">Food</a></li>
                    <li><a href="manage.order.php" class="myButton">Order</a></li>
                    <li><a href="logout.php" class="myButton">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu section end-->