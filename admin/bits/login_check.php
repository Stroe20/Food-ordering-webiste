

<?php 

//Authorization - Access Control
//Check if user is logged in or not
if(!isset($_SESSION['user']))//If session is not check
{
    //User is not logged in
    //Redirect to login page
    $_SESSION['no_login_message']="<div class = 'error text-center'>Login to acces admin panel</div>";
    header('location:'.SITEURL.'admin/login.php');


}
?>