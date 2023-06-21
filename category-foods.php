<?php include('parts_front/menu.php');?>
<?php

    //check if id is passed
    if(isset($_GET['category_id']))
    {
        //category id is set and get id
        $category_id=$_GET['category_id'];
        //get title based on category
        $sql = "SELECT title From category WHERE id=$category_id";
        $res = mysqli_query($conn,$sql);
        $row =  mysqli_fetch_assoc($res);
        $category_title=$row['title'];
    }else{
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
            
                //query to get food based on categ
                $sql2="SELECT * FROM food WHERE category_id=$category_id";
                $res2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($res2);
                if($count2>0)
                {
                    //food avalabile
                    while($row2=mysqli_fetch_assoc($res2)){
                        $id=$row2['id'];
                        $title = $row2['title'];
                        $price= $row2['price'];
                        $description = $row2['description'];
                        $image_name= $row2['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php
                                    
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not avalabile</div>";
                                    }else{
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>"  class="img-responsive img-curve">
                                        <?php
                                    }
                                
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title?></h4>
                                <p class="food-price">$<?php echo $price?></p>
                                <p class="food-detail">
                                <?php echo $description?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id ;?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo"<div class='error'>Food not avalabile</div>";
                }
            
            ?>

           
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('parts_front/footer.php');?>