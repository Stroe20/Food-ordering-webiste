<?php
include('secure/log.php');

    //check if the id and image_name value is set 
    if(isset($_GET['id'])&& isset($_GET['image_name']))
    {
        //get the value and delete
       
        // echo"get value and delete";
        $id = $_GET['id'];
        $image_name =$_GET['image_name'];

        //remove the physical img

        if($image_name !="")
        {
            //img is avalabile
            $path ="../images/food/".$image_name;
            //remove image
            $remove = unlink($path);
            //if failed to remove
            if($remove==false)
            {
                $_SESSION['remove']= "<div class='error'>Failed to remove food image</div>";
                header('location:'.SITEURL.'admin/manage.food.php');
                die();
            }
        }

        //delete data from database
        $sql = "DELETE FROM food WHERE id='$id'";
        //execute query
        $res = mysqli_query($conn,$sql);
        //check if deleted
        if($res==true)
        {
                $_SESSION['delete']="<div class='success'>Food deleted</div>";
                header('location:'.SITEURL.'admin/manage.food.php');
        }else{
            $_SESSION['delete']="<div class='error'>Food was not deleted</div>";
            header('location:'.SITEURL.'admin/manage.food.php');
        }
        //redirect to manage categ with message
    }else{
        //redirect to Manage food page
        $_SESSION['delete']="<div class='error'>Unauthorized</div>";
        header('location:'.SITEURL.'admin/manage.food.php');
    }

?>