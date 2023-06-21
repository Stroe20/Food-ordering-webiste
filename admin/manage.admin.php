<?php include('bits/menu.php')?>

 



        <div class="main">
            <div class="wrapper">
                <h1>Manage admin</h1>
                <br />
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user_not_found'])){
                        echo $_SESSION['user_not_found'];
                        unset($_SESSION['user_not_found']);
                    }
                    if(isset($_SESSION['pass_not_match'])){
                        echo $_SESSION['pass_not_match'];
                        unset($_SESSION['pass_not_match']);
                    }
                    if(isset($_SESSION['pass_change'])){
                        echo $_SESSION['pass_change'];
                        unset($_SESSION['pass_change']);
                    }
                ?>
                <br><br><br>
                <a href="add.admin.php" class="addbutton">ADD ADMIN</a>
                <br /><br /><br />
                <table class="table-full">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Actions</th>
                        
                    </tr>
                    <?php
                        $sql = "SELECT * FROM admin";
                        $res = mysqli_query($conn,$sql);

                        if($res==TRUE)
                        {
                            $count = mysqli_num_rows($res);
                            $sn=1;

                            if($count>0)
                            {
                                while ($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['ID'];
                                    $username=$rows['username'];
                                    ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                            <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id;?>" class="addbutton">CHANGE PASSWORD</a>
                                            <a href="<?php echo SITEURL; ?>admin/update_Admin.php?id=<?php echo $id;?>" class="addbutton">UPDATE ADMIN</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id;?>" class="deletebutton">DELETE ADMIN</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }
                        }else{


                        }
                    ?>
                </table>


            </div>
        </div>



         <?php include('bits/footer.php')?>