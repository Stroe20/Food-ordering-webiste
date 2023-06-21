<?php include('bits/menu.php')?>
<div class="main">
    <div class="header">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            $id=$_GET['id'];
        ?>
        <form action="" method="POST">

            <table class="table-30">
                <tr>
                    <td>Old password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">
                    </td>
                </tr>
                <td>New password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
                <td>Confirm password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                </tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">    
                    <input type="submit" name="submit" value="CHANGE PASSWORD" class="addbutton">
                </td>

            </table>


        </form>
    </div>
</div>
<?php

    //check if the submit button is clicked
    if (isset($_POST['submit']))
    {
        //echo "yes";
        //1. get the data from form
        $id=$_POST['id'];
        $current_password= md5($_POST['current_password']);
        $new_password= md5($_POST['new_password']);
        $confirm_password= md5($_POST['confirm_password']);
        //2.check if the user with current id and password exists
        $sql="SELECT * FROM admin  WHERE id='$id' and password='$current_password'";
        //execute the query
        $res= mysqli_query($conn,$sql);
        if($res==TRUE)
        {
            //check if the data is avalabile
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                //user exists and password can be changed
                //echo"User found";
                //check if new and confirm are the same
                if($new_password==$confirm_password)
                {
                    //update password
                    $sql2="UPDATE admin SET
                    password='$new_password'
                    WHERE id='$id'
                    ";
                    //execute query
                    $res2=mysqli_query($conn,$sql2);
                    //check if query executed
                    if($res2==true){
                        $_SESSION['pass_change']="<div class='success'>Password changed</div>";
                        header('location:'.SITEURL.'admin/manage.admin.php');
                    }
                    else{
                        $_SESSION['pass_change']="<div class='error'>Failed to change password</div>";
                        header('location:'.SITEURL.'admin/manage.admin.php');
                    }
                }else{
                    //error and redirect
                    $_SESSION['pass_not_match']="<div class='error'>Passwords don't match</div>";
                    header('location:'.SITEURL.'admin/manage.admin.php');
                }
            }else{
                //user does not exist
                $_SESSION['user_not_found']="<div class='error'>User not found</div>";
                //redirect user
                header('location:'.SITEURL.'admin/manage.admin.php');
            }
        }
        //3.check if new and current password are the same
        //4. change pass if all the above are true
    }

?>
<?php include('bits/footer.php')?>