<?php include('bits/menu.php')?>
<div class="main">
             <div class="wrapper">
                <h1>Update category</h1>
                <br /><br />

                <?php
                
                //check i fid is check
                if(isset($_GET['id'])){
                    //get details
                    $id=$_GET['id'];
                    $sql="SELECT * FROM category WHERE id=$id";
                    $res = mysqli_query($conn,$sql);
                    $count =mysqli_num_rows($res);

                    if($count==1)
                    {
                        //get data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image =$row['image_name'];
                        $featured= $row['featured']; 
                        $active= $row['active'];
                    }else{
                        //redirect with message
                        $_SESSION['no_category_found']="<div class='error'>Category not found</div>";
                        header('location:'.SITEURL.'admin/manage.category.php');
                    }
                }else{
                    //redirect
                    header('location:'.SITEURL.'admin/manage.category.php');
                }

                ?>
                                    
                <form action="" method="POST" enctype="multipart/form-data">

                    <table class="table-30">
                        <tr>
                            <td>Title: </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $title;?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Current image: </td>
                            <td>
                                <?php
                                
                                    if($current_image!=""){
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>"width="150px" >
                                        <?php

                                    }else{
                                        echo"<div class='error'>Image not found</div>";
                                    }

                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                New image:
                            </td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>

                        <tr>
                            <td>Featured: </td>
                            <td>
                            <input <?php if($featured=="Yes") echo"checked";?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured=="No") echo"checked";?> type="radio" name="featured" value="No"> No
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>Active: </td>
                            <td>
                            <input <?php if($active=="Yes") echo"checked";?> type="radio" name="active" value="Yes"> Yes
                                <input <?php if($active=="No") echo"checked";?> type="radio" name="active" value="No"> No
                            </td>
                        </tr>
                        <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="UPDATE CATEGORY" class="addbutton">
                        </td>
                        </tr>
                    </table>
                </form>

                    <?php
                    
                        if(isset($_POST['submit'])){
                            //echo "clicked";
                            //1.get values
                            $id=$_POST['id'];
                            $title=$_POST['title'];
                            $current_image=$_POST['current_image'];
                            $active=$_POST['active'];
                            $featured=$_POST['featured'];
                           
                            //2. update image
                            //check if img is selected
                            if(isset($_FILES['image']['name'])){
                                //get details
                                //img avalabile
                                $image_name=$_FILES['image']['name'];
                                if($image_name !=""){
                                    //upload img

                                        //auto rename img
                                        //get the extension of the img
                                        $extt = explode('.',$image_name);
                                        $ext = end($extt);

                                        //rename the img
                                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;


                                        $source_path=$_FILES['image']['tmp_name'];
                                        $destination_path="../images/category/".$image_name;
                                        $upload = move_uploaded_file($source_path,$destination_path);

                                        //check if the img is uploaded
                                        if($upload==false){
                                            //set message
                                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                            header('location:'.SITEURL.'admin/add_category.php');
                                            die();
                                         }
                                    //remove old img if avalabile
                                    if($current_image!=""){
                                        $remove_path = "../images/category/".$current_image;
                                        $remove = unlink($remove_path);
                                        //check if it was removed
                                        //if failed to remove
                                        if($remove==false)
                                        {
                                            $_SESSION['failed_to_remove_img']= "<div class = 'error'>Failed to remove image</div";
                                            header('location:'.SITEURL.'admin/manage.category.php');
                                            die();
                                        }}

                                }else{
                                    $image_name= $current_image;
                                }
                            }else{
                                $image_name= $current_image;
                            }
                            //3.update database
                            $sql2="UPDATE category SET
                            title='$title',
                            image_name='$image_name',
                            featured='$featured',
                            active='$active'
                            WHERE id=$id
                            ";
                            $res2 = mysqli_query($conn,$sql2);
                            //4.redirect
                            if($res2==true){
                                //cat updated
                                $_SESSION['update']="<div class='success'>Category updated successfully</div>";
                                header('location:'.SITEURL.'admin/manage.category.php');
                            }else{
                                //failed to update category
                                $_SESSION['update']="<div class='error'>Failed to update</div>";
                                header('location:'.SITEURL.'admin/manage.category.php');
                            }
                            
                        }
                    
                    ?>

             </div>
</div>



<?php include('bits/footer.php')?>