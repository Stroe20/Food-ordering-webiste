<?php include('secure/log.php')?>

<div class="main"></div>
    <div class="wrapper">
        <h1>Register</h1>
        <br /> <br />
        <?php
            if(isset($_SESSION['add']))
            {   echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
        ?>
        <form action="" method="post">

        <table class="table-30">
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" placeholder="Enter username" ></td>
                
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" placeholder="Enter password" ></td>
                
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="REGISTER" class="addbutton">
                </td>
            </tr>
        </table>

        </form>
    </div>


<?php

if (isset($_POST['submit']))

{
    $username =$_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO user SET
    username='$username',
    password='$password'
    ";



    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    if($res==TRUE)
    {
        $_SESSION['add']= "<div class='success'>Registered succesfully</div>";
        header("location:".SITEURL.'admin/user.php');
    }else{
        $_SESSION['add']= "<div class='error'>Failed to register</div>";
        header("location:".SITEURL.'admin/add_user.php');
    }
} 
?>