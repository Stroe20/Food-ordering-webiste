<?php include('bits/menu.php')?>

    <div class="main">
        <div class="wrapper">
            <h1>Add Category</h1>
            
            <br><br>

            <?php
            
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>

            <br><br>
            <!--Form start-->
            <form action="" method="POST" enctype="multipart/form-data">

                <table class="table-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category name">
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
                        <input type="submit" name="submit" value="ADD CATEGORY" class="addbutton">
                    </td>
                </tr>
                </table>
            </form>
            <!--Form end-->
            <?php 
            
            //check if submit button is clicked
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1. get value from category form
                 $title=$_POST['title'];

                 //for radio input type we need to check if the button is selected or not
                 if(isset($_POST['featured'])){
                    //get value
                    $featured=$_POST['featured'];
                 }else{
                    //set default value
                    $featured="No";
                 }
                 if(isset($_POST['active'])){
                    //get value
                    $active=$_POST['active'];
                 }else{
                    //set default value
                    $active="No";
                 }
                 //check if the image is selected 
                 //print_r($_FILES['image']);

                //    die();//break code
                if(isset($_FILES['image']['name'])){
                        //upload img
                        $image_name=$_FILES['image']['name'];
                        //upload img only if image is selected
                        if($image_name !="")
                        {

                        
                        //auto rename img
                        //get the extension of the img
                        $extt = explode('.',$image_name);
                        $ext=end($extt);

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
                        }
                }else{
                    //do not upload img and set the img value as blank
                    $image_name="";
                }

                 //2. create sql query to insert into category database
                 $sql="INSERT INTO category SET
                 title='$title',
                 image_name='$image_name',
                 featured='$featured',
                 active='$active'
                 ";
                 //3. execute query
                 $res = mysqli_query($conn,$sql);

                 //4.Check if the query  executed
                 if($res==TRUE)
                 {
                    //query executed and cat added
                    $_SESSION['add']="<div class='success'>Category added successfully</div>";
                    //redirect to manage cat page
                    header('location:'.SITEURL.'admin/manage.category.php');
                 }else{
                    //failed to add
                    $_SESSION['add']="<div class='error'>Failed to add category</div>";
                    //redirect to add cat page
                    header('location:'.SITEURL.'admin/add_category.php');
                 }
            
            }
            
            ?>
        </div>
    </div>

<?php include('bits/footer.php')?>