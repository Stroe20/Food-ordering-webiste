
<?php include('secure/log.php')?>
<html>

    <head>
        <title>Login-Food order</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

<div class="login">
    <h1 class="text-center">Welcome</h1>
    <br><br>

    <br><br>
    <?php
            if(isset($_SESSION['add']))
            {   echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
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
    
    <form action="" method="POST" class="text-center">

        <input type="submit" name="submit" value="Register" class="addbutton">

        <input type="submit" name="submit2" value="Login" class="addbutton">
        <input type="submit" name="submit3" value="Guest" class="addbutton">
        <br><br>

    </form>
   
    <p class="text-center">Created by Stroe Marian</p>


</div>

    </body>

</html>

<?php

//check submit button
if(isset($_POST['submit']))
{
 
        header('location:'.SITEURL.'admin/add_user.php');
    
}
if(isset($_POST['submit2']))
{
 
        header('location:'.SITEURL.'admin/login_user.php');
    
}
if(isset($_POST['submit3']))
{
 
        header('location:'.SITEURL);
    
}

?>