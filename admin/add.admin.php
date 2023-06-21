<?php include('bits/menu.php')?>

<div class="main"></div>
    <div class="wrapper">
        <h1>ADD ADMIN</h1>
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
                    <input type="submit" name="submit" value="ADD ADMIN" class="addbutton">
                </td>
            </tr>
        </table>

        </form>
    </div>

<?php include('bits/footer.php')?>
<?php

if (isset($_POST['submit']))

{
    $username =$_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO admin SET
    username='$username',
    password='$password'
    ";



    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    if($res==TRUE)
    {
        $_SESSION['add']= "<div class='success'>Admin added succesfully</div>";
        header("location:".SITEURL.'admin/manage.admin.php');
    }else{
        $_SESSION['add']= "<div class='error'>Failed to add admin</div>";
        header("location:".SITEURL.'admin/addadmin.php');
    }
} 
?>
