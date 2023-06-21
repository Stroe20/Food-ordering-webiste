<?php include('bits/menu.php')?>
<div class="main">
            <div class="wrapper">
                <h1>Manage food</h1>
                <br /><br />
                <a href="<?php echo SITEURL; ?>admin/add_food.php" class="addbutton">ADD FOOD</a>
                <br /><br /><br />

                    <?php
                    
                        if(isset($_SESSION['add']))
                        {   echo$_SESSION['add'];
                            unset($_SESSION['add']);
                        }
                        if(isset($_SESSION['delete'])){
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }
                        if(isset($_SESSION['no_food_found'])){
                            echo $_SESSION['no_food_found'];
                            unset($_SESSION['no_food_found']);
                        }
                        if(isset($_SESSION['upload'])){
                            echo$_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
                        if(isset($_SESSION['failed_to_remove_img'])){
                            echo $_SESSION['failed_to_remove_img'];
                            unset($_SESSION['failed_to_remove_img']);
                        }
                        if(isset($_SESSION['update'])){
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }
                    
                    ?>


                <table class="table-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                        
                    </tr>
                    <?php 
                        //create sql query
                        $sql = "SELECT*FROM food";
                        $res = mysqli_query($conn,$sql);
                        $count = mysqli_num_rows($res);
                        $sn=1;
                        if($count>0)
                        {
                            //food in database
                            //get data and display
                            while($row=mysqli_fetch_assoc($res)){
                                $id=$row['id'];
                                $title=$row['title'];
                                $price=$row['price'];
                                $image_name=$row['image_name'];
                                $featured=$row['featured'];
                                $active=$row['active'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++ ;?></td>
                                        <td><?php echo $title ;?></td>
                                        <td><?php echo $price ;?></td>
                                        <td>
                                            <?php 
                                                //check if we have img or not
                                                if($image_name==""){
                                                    echo"<div class='error>Image not added</div>";
                                                }else{
                                                    ?>
                                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name ; ?>" width="100px">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured ;?></td>
                                        <td><?php echo $active ;?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update_food.php?id=<?php echo $id ; ?>&image_name=<?php echo $image_name ;?>" class="addbutton">UPDATE FOOD</a>
                                            <a href="<?php echo SITEURL;?>admin/delete_food.php?id=<?php echo $id ; ?>&image_name=<?php echo $image_name ;?>" class="deletebutton">DELETE FOOD</a>
                                        </td>



                                    </tr>

                                <?php
                            }
                        }else{
                            //food not added
                            echo"<tr> <td colspan='7' class='error'> Food not added yet</td></tr>";
                        }
                    ?>


                </table>

            </div>
        </div>
<?php include('bits/footer.php')?>