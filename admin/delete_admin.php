<?php
    // Include log.php file
    include('secure/log.php');

    //1. get the ID of Admin to be deleted
     $id=$_GET['id'];

    //2. Create sql query to delete admin
    $sql= "DELETE FROM admin WHERE id=$id";

    //Execute the query

    $res=mysqli_query($conn,$sql);

    //Check if it is executed succesfully
    if($res==true)
    {
        //Admin deleted
        //echo"Admin deleted";
        //Create session Variable to display message
        $_SESSION['delete']= "<div class='success'>Admin deleted succesfully</div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage.admin.php');
    }else{
        //Failed to delete
        //echo"Failed to delete";
        $_SESSION['delete']= "<div class='error'>Failed to delete admin</div>";
        header('location:'.SITEURL.'admin/manage.admin.php');
    }
    //3. redirect to managa admin page with messages

?>