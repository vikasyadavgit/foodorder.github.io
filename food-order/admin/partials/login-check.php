<?php 
    // Authorization - Access Control
    //Check Whether the User is Logged In or Not.
    if(!isset($_SESSION['user'])) // If user session is not SET
    {
        //User Not Logged In
        //Redirect to login Page with Message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Login To Access Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>