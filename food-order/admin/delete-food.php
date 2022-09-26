<?php 

//Include Constants page
include('../config/constants.php');

//echo "Delete Food Page"; 

if(isset($_GET['id']) && isset($_GET['image_name']))  //Either use '&&' or 'And'
{
    //Process to delete
    //echo "Process to Delete";

    //1. Get ID and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. Remove the image if available
    //Check Whether the image is available or not and delete if available
    if($image_name != "")
    {
        //Image is available and need to remove from folder
        //Get the image path
        $path = "../images/food/".$image_name;

        //Remove image file from folder
        $remove = unlink($path);

        //Check whether the image is removed or not
        if($remove==false)
        {
            //Failed to remove image
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image file.</div>";
            //Redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
            //Stop the process of delete
            die();
        }
    }

    //3. Delete Food to Database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //Execute the query
    $res = mysqli_query($conn,$sql);

    //Check whether the query is executed or not and set the session message respectively
    //4.Redirect to Manage Food with session message
    if($res==true)
    {
        //Food Deleted
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //Failed to delete food
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

    
}
else
{
    //Redirect to manage Page
    //echo "Redirect";
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}


?>