<?php include('bits/menu.php')?>

<div class="main">
            <div class="wrapper">
                <h1>Add Food</h1>

                <br><br>

                    <?php
                    
                        if(isset($_SESSION['upload']))
                        {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
                    
                    ?>

                <form action="" method="POST" enctype="multipart/form-data">

                    <table class="table-30">
                        <tr>
                            <td>Title: </td>
                            <td>
                                <input type="text" name="title" placeholder="Food name">
                            </td>
                        </tr>
                        <tr>
                            <td>Description: </td>
                            <td>
                                <textarea name="description" cols="30" rows="5" placeholder="Description of the food name"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Price: </td>
                            <td>
                                <input type="number" name="price" >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Select image:
                            </td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>
                        <tr>
                            <td>Category: </td>
                            <td>

                                <select name="category">


                                    <?php
                                    
                                        //display category from database
                                        //1.create sql
                                        $sql= "SELECT * FROM category WHERE active='Yes'";

                                        $res =mysqli_query($conn,$sql);
                                        $count = mysqli_num_rows($res);
                                        
                                        if($count>0){
                                            //we have categories
                                            while($row=mysqli_fetch_assoc($res)){
                                                //get the details of categ
                                                $id=$row['ID'];
                                                $title=$row['title'];
                                                ?>
                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option> 
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
                            <td>Featured: </td>
                            <td>
                                <input type="radio" name="featured" value="Yes"> Yes
                                <input type="radio" name="featured" value="No"> No
                            </td>
                        </tr>
                        <br>
                        <tr>
                            <td>Active: </td>
                            <td>
                                <input type="radio" name="active" value="Yes"> Yes
                                <input type="radio" name="active" value="No"> No
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="ADD FOOD" class="addbutton">
                            </td>
                        </tr>
                    </table>
                </form>


                <?php
                
                //check if the button is clicked
                if(isset($_POST['submit']))
                {
                    //echo"clicked";
                    //1. get data from form
                    $title =$_POST['title'];
                    $description= $_POST['description'];
                    $price=$_POST['price'];
                    $category=$_POST['category'];
                    //check if featured/active is on
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }else{
                        $featured="No";
                    }
                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }else{
                        $active="No";
                    }
                    //2.upload the img if selected
                    //check if the selected img is clicked
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name=$_FILES['image']['name'];
                        if($image_name!="")
                        {
                            //img is selected
                            //rename img
                                $extt=explode('.',$image_name);
                                $ext=end($extt);
                                // create new name

                                $image_name="Food_name_".rand(0000,9999).".".$ext;
                            //upload img
                            //get source and destination path

                            $src=$_FILES['image']['tmp_name'];
                            $dst="../images/food/".$image_name;

                            $upload = move_uploaded_file($src,$dst);
                            //check if img uploaded
                            if($upload==false){
                                //failed  to upload
                                //redirect and stop the procces
                                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                header('location:'.SITEURL.'admin/add_food.php');
                                die();
                            }

                        }

                    }else{
                        $image_name="";
                    }
                    //3. insert into database.
                        $sqll = "INSERT INTO food SET
                            
                            title='$title',
                            description='$description',
                            price='$price',
                            image_name='$image_name',
                            category_id='$category',
                            featured='$featured',
                            active='$active'
                        ";

                        $ress =mysqli_query($conn,$sqll);

                        if($ress == true){
                            $_SESSION['add']="<div class='success'>Food added successfully</div>";
                            header('location:'.SITEURL.'admin/manage.food.php');
                        }else{
                            $_SESSION['add']="<div class='error'>Failed to add food</div>";
                            header('location:'.SITEURL.'admin/manage.food.php');
                        }
                    //4.redirect with message
                }
                
                ?>
            </div>
</div>


<?php include('bits/footer.php')?>