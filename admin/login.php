<?php include('secure/log.php')?>
<html>

    <head>
        <title>Login-Food order</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

<div class="login">
    <h1 class="text-center">Login Admin</h1>
    <br><br>
    <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no_login_message'])){
            echo $_SESSION['no_login_message'];
            unset($_SESSION['no_login_message']);
        }
    ?>
    <br><br>
    <!-- Login form start-->
    <form action="" method="POST" class="text-center">
        Username: <br>
        <input type="text" name="username" placeholder="Enter username"><br><br>
        Password:<br>
        <input type="password" name="password" placeholder="Enter password"><br><br>

        <input type="submit" name="submit" value="Login" class="addbutton">
        <br><br>

    </form>
    <!-- Login form end-->
    <p class="text-center">Created by Stroe Marian</p>


</div>

    </body>

</html>

<?php

//check submit button
if(isset($_POST['submit']))
{
    //Process for login
    //1.Get the Data from login form
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $raw_password=md5($_POST['password']);
    $password=mysqli_real_escape_string($conn,$raw_password);

    //2.sql to check if the user exists
    $sql="SELECT *FROM admin WHERE username='$username' AND password='$password'";

    //3. execute query
    $res=mysqli_query($conn,$sql);


    //4.Count rows to check if the user exists
    $count = mysqli_num_rows($res);
    if($count==1)
    {
        //User avalabile and login successful
        $_SESSION['login']="<div class = 'success'>Login Successful</div>";
        $_SESSION['user']=$username;//To check if user is logged in or not
        header('location:'.SITEURL.'admin/');
    }else
    {
        //User not avalabile
        $_SESSION['login']="<div class = 'error text-center'>Username or Password did not match</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

}

?>