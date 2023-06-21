<?php
    include('secure/log.php');
    //Destroy session
    session_destroy();//Unsets $_Session and user
    //Redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>