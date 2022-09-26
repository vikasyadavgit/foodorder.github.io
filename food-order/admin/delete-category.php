<?php 
     //Include Constants File
     include('../config/constants.php');

    //echo "Delete Page";
    //Check Whether the id and image_name is set or not
    if(isset($_GET['id'])AND isset($_GET['image_name']))
    {
        //Get the value and Delete 
        //echo "Get value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the Physical image file if available
        if($image_name != "")
        {
            //Image is available So remove it
            $path = "../images/category/".$image_name;
            //Remove the Image
            $remove = unlink($path);

            //If failed to remove Image than add an errror message and stop the process
            if($remove==false)
            {
                //Set the session Message
                $_SESSION['remove'] = "<div class='error'>Failed To Remove Image.</div>";
                //Redirect to Manage Category Page
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop then Process
                die();
            }
        }

        //Delete Data from Database
        //SQL query delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the query
        $res = mysqli_query($conn,$sql);

        //Check Whether the data is deleted from database or not
        if($res==true)
        {
            //Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set Error Message and Redirecct
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');

        }

        //Redirect to Manage Category Page with Message
    }
    else
    {
        //Redirect to Mange Category Page
        header('location:'.SITEURL.'admin/manage-category.php');

    } 

?>