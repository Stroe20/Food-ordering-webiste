<?php include('bits/menu.php')?>
<div class="main">
             <div class="wrapper">
                <h1>Update food</h1>
                <br /><br />

                <?php
                
                //check i fid is check
                if(isset($_GET['id'])){
                    //get details
                    $id=$_GET['id'];
                    $sql="SELECT * FROM food WHERE id=$id";
                    $res = mysqli_query($conn,$sql);
                    $count =mysqli_num_rows($res);

                    if($count==1)
                    {
                        //get data
                        $row2 = mysqli_fetch_assoc($res);
                        $title = $row2['title'];
                        $current_image =$row2['image_name'];
                        $featured= $row2['featured']; 
                        $active= $row2['active'];
                        $description=$row2['description'];
                        $price=$row2['price'];
                        $current_category=$row2['category_id'];
                    }else{
                        //redirect with message
                        $_SESSION['no_food_found']="<div class='error'>Food not found</div>";
                        header('location:'.SITEURL.'admin/manage.food.php');
                    }
                }else{
                    //redirect
                    header('location:'.SITEURL.'admin/manage.food.php');
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
                            <td>Description: </td>
                            <td>
                                <textarea name="description" cols="30" rows="5" ><?php echo $description;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Price: </td>
                            <td>
                                <input type="number" name="price" value="<?php echo $price;?>" >
                            </td>
                        </tr>
                        <tr>
                            <td>Category: </td>
                            <td>

                                <select name="category" >


                                    <?php
                                    
                        
                                        $sql2= "SELECT * FROM category WHERE active='Yes'";

                                        $res2 =mysqli_query($conn,$sql2);
                                        $count = mysqli_num_rows($res2);
                                        
                                        if($count>0){
                                            //we have categories
                                            while($row=mysqli_fetch_assoc($res2)){
                                                //get the details of categ
                                                $category_id=$row['id'];
                                                $category_title=$row['title'];
                                                ?>
                                                <option <?php if($current_category==$category_id) echo"Selected";?>value="<?php echo $category_id;?>"><?php echo $category_title;?></option> 
                                                <?php
                                            }
                                        }else{
                                            //we do not have cat
                                            ?>
                                            <option value="0">No category found</option>
                                            <?php
                                        }

                                    ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td>Current image: </td>
                            <td>
                                <?php
                                
                                    if($current_image!=""){
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>"width="150px" >
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
                            <input type="submit" name="submit" value="UPDATE FOOD" class="addbutton">
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
                            $description= $_POST['description'];
                            $price=$_POST['price'];
                            $category=$_POST['category'];
                            $current_image=$_POST['current_image'];
                            $featured=$_POST['featured'];
                            $active=$_POST['active'];
                            
                           
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
                                        $image_name = "Food_name_".rand(000,999).'.'.$ext;


                                        $source_path=$_FILES['image']['tmp_name'];
                                        $destination_path="../images/food/".$image_name;
                                        $upload = move_uploaded_file($source_path,$destination_path);

                                        //check if the img is uploaded
                                        if($upload==false){
                                            //set message
                                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                            header('location:'.SITEURL.'admin/manage.food.php');
                                            die();
                                         }
                                    //remove old img if avalabile
                                    if($current_image!=""){
                                        $remove_path = "../images/food/".$current_image;
                                        $remove = unlink($remove_path);
                                        //check if it was removed
                                        //if failed to remove
                                        if($remove==false)
                                        {
                                            $_SESSION['failed_to_remove_img']= "<div class = 'error'>Failed to remove image</div";
                                            header('location:'.SITEURL.'admin/manage.food.php');
                                            die();
                                        }}

                                }else{
                                    $image_name= $current_image;
                                }
                            }else{
                                $image_name= $current_image;
                            }
                            //3.update database
                            $sql3="UPDATE food SET
                                title='$title',
                                description='$description',
                                price='$price',
                                image_name='$image_name',
                                category_id='$category',
                                featured='$featured',
                                active='$active'
                                WHERE id=$id
                            ";
                            $res3 = mysqli_query($conn,$sql3);
                            //4.redirect
                            if($res3==true){
                                //cat updated
                                $_SESSION['update']="<div class='success'>Food updated successfully</div>";
                                header('location:'.SITEURL.'admin/manage.food.php');
                            }else{
                                //failed to update food
                                $_SESSION['update']="<div class='error'>Failed to update</div>";
                                header('location:'.SITEURL.'admin/manage.food.php');
                            }
                            
                        }
                    
                    ?>

             </div>
</div>



<?php include('bits/footer.php')?>
