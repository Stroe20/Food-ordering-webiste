<?php include('bits/menu.php')?>

<div class="main">
    <div class="wrapper">
        <hi>Update Admin</hi>
        <br><br>
        <?php
            //1. get id 
            $id=$_GET['id'];
            //2. create sql query
            $sql="SELECT * FROM admin WHERE id=$id";
            //Execute query
            $res=mysqli_query($conn,$sql);
            //check 
            if($res==TRUE)
            {
                //if data is avalabile
                $count = mysqli_num_rows($res);
                //if we have admin data
                if($count==1)
                {
                    //get details
                   $row=mysqli_fetch_assoc($res);
                   $username=$row['username'];
                }else{
                    //redirect to managa admin page
                    header('location:'.SITEURL.'admin/manage.admin.php');
                }
            }
        ?>
        <form action="" method="post">

        <table class="table-30">
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo $username;?>" ></td>
                
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="UPDATE ADMIN" class="addbutton">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>
<?php
    //check if submit button is clicked
    if(isset($_POST['submit']))
    {
       // echo "click";
       //get the values from form to update
        echo $id=$_POST['id'];
       echo $username=$_POST['username'];
       //create query to update admin
       $sql="UPDATE admin SET
       username='$username'
       WHERE id='$id'";
       //execute query
       $res = mysqli_query($conn,$sql);
       //check if executed
       if($res==TRUE)
       {
        //works
        $_SESSION['update']="<div class= 'success'>Admin updated succesfully</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage.admin.php');
       }else{
        //if it failed
        $_SESSION['update']="<div class= 'error'>Admin did not update</div>";
        header('location:'.SITEURL.'admin/manage.admin.php');
       }
    } 

?>

<?php include('bits/footer.php')?>