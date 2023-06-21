<?php include('bits/menu.php')?>
<div class="main">
            <div class="wrapper">
                <h1>Manage category</h1>
                <br /><br />
                    <?php
            
                        if(isset($_SESSION['add']))
                            {
                                 echo $_SESSION['add'];
                                 unset($_SESSION['add']);
                            }
                            if(isset($_SESSION['remove']))
                            {
                                echo $_SESSION['remove'];
                                unset($_SESSION['remove']);
                            }
                            if(isset($_SESSION['delete']))
                            {
                                echo $_SESSION['delete'];
                                unset($_SESSION['delete']);
                            }
                            if(isset($_SESSION['no_category_found']))
                            {
                                echo $_SESSION['no_category_found'];
                                unset($_SESSION['no_category_found']);
                            }
                            if(isset(   $_SESSION['update']))
                            {
                                echo    $_SESSION['update'];
                                unset(   $_SESSION['update']);
                            }
                            if(isset($_SESSION['upload']))
                            {
                                echo $_SESSION['upload'];
                                unset($_SESSION['upload']);
                            }

                            if(isset($_SESSION['failed_to_remove_img']))
                            {
                                echo $_SESSION['failed_to_remove_img'];
                                unset($_SESSION['failed_to_remove_img']);
                            }
                         

                    ?>
                 <br><br>
                <a href="<?php echo SITEURL;?>admin/add_category.php" class="addbutton">ADD CATEGORY</a>
                <br /><br /><br />
                <table class="table-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                        
                    </tr>


                    <?php
                    
                            //query to get all cat from database
                            $sql = "SELECT *FROM category";
                            //execute query
                            $res = mysqli_query($conn,$sql);
                            //count rows
                            $count = mysqli_num_rows($res);
                            //create serial number variable
                            $sn=1;
                            //check if there is data in database or not
                            if($count>0)
                            {
                                //we have data

                                //get the data and display
                                while($row=mysqli_fetch_assoc($res)){
                                    $id = $row['ID'];
                                    $title=$row['title'];
                                    $image_name=$row['image_name'];
                                    $active=$row['active'];
                                    $featured=$row['featured'];
                                    
                                    ?>

                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $title;?></td>

                                    <td>
                                        <?php 
                                            //check if img name is avalabile
                                            if($image_name!=""){
                                                //display img
                                                ?>

                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"width="100px">

                                                <?php
                                            }else{
                                                //display msg
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $active;?></td>
                                    <td><?php echo $featured;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL ;?>admin/update_category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="addbutton">UPDATE CATEGORY</a>
                                        <a href="<?php echo SITEURL ;?>admin/delete_category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="deletebutton">DELETE CATEGORY</a>
                                    </td>
                                </tr>


                                    <?php


                                }

                            }else{
                                //we do not have data
                                //we'll display the message
                                ?>

                                <tr>
                                    <td colspan="6"><divc lass = "error">No category added</div></td>
                                </tr>

                                <?php
                            }
                    
                    ?>


                </table>
            </div>
        </div>
<?php include('bits/footer.php')?>