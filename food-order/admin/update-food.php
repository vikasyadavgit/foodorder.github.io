<?php include('partials/menu.php');?>

<?php 
    //Check whether id is set or not
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //Sql query to get the selected food
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        //Execute the query
        $res2 = mysqli_query($conn,$sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the individual value of selected Food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        //Redirect to Manage food
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

        <tr>
            <td>Title:</td>
            <td>
                <input type="text" name="title" value="<?php echo $title; ?>" >
            </td>
        </tr>

        <tr>
            <td>Description:</td>
            <td>
                <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
            </td>
        </tr>

        <tr>
            <td>Price:</td>
            <td>
                <input type="number" name="price" min="0" value="<?php echo $price; ?>">
            </td>
        </tr>

        <tr>
            <td>Current Image:</td>
            <td>
                <?php 
                    //Check whether image is available or not
                    if($current_image == "")
                    {
                        //Image Not Available
                        echo "<div class='error'>Image not Available.</div>";
                    }
                    else
                    {
                        //Image Available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="100px">
                        <?php
                    }
                ?>
            </td>
        </tr>

        <tr>
            <td>Select New Image:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Category:</td>
            <td>
                <select name="category">

                    <?php 
                        //Query to get active categories
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        //Execute the query
                        $res = mysqli_query($conn,$sql);
                        //Count Rows
                        $count = mysqli_num_rows($res);

                        //Check whether category available or not
                        if($count>0)
                        {
                            //Category Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_title = $row['title'];
                                $category_id = $row['id'];

                                //echo "<option value='$category_id'>$category_title</option>";
                                ?>
                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                            }
                        }
                        else
                        {
                            //Category Not Availble
                            echo "<option value='0'>Category Not Available.</option>";
                        }
                    ?>

                   
                </select>
            </td>
        </tr>

        <tr>
            <td>Featured:</td>
            <td>
                <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No">No
            </td>
        </tr>
        
        <tr>
            <td>Active:</td>
            <td>
                <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="submit" name="submit" value="Update Food" class="btn-secondary">
            </td>
        </tr>

        </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Upload the image if selected

                //Check whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload Button Clicked
                    $image_name = $_FILES['image']['name']; //New Image Name

                    //Check whether the file is available or not
                    if($image_name != "")
                    {
                        //Image is available
                        //A. Uploading New Image
                        //Rename the image
                        $ext = end(explode('.', $image_name)); //Gets the extension of image

                        $image_name = "Food-Name".rand(0000,9999).'.'.$ext; //Rename the image

                        //Get the source and destination path
                        $src_path = $_FILES['image']['tmp_name']; //Source Path
                        $dest_path = "../images/food/".$image_name; //Destination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path,$dest_path);

                        //Check whether the image uploaded or not
                        if($upload==false)
                        {
                            //Failed to upload image
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image</div>";
                            //Redirect to Manage Food
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //Stop the Process
                            die();
                        }

                        //3. Remove the image if new image uploaded and new image upload
                        //B. Remove current image if available
                        if($current_image != "")
                        {
                            //Current Image is Available
                            //Remove the image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false)
                            {
                                //Failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to Remove Current Image.</div>";
                                //Redirect to manage food
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //Stop the process
                                die();
                            }

                        }

                    }
                    else
                    {
                        $image_name = $current_image; //Default image when image is not selected
                    }
                }
                else
                {
                    $image_name = $current_image; //Default image when Button is not clicked
                }

                

                //4. Update the Food in database
                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //Execute the sql query
                $res3 = mysqli_query($conn,$sql3);

                //Check Whether the query executed or not
                if($res3==true)
                {
                    //Query Executed and food updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Failed to update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }
        
        ?>

    </div>
</div>


<?php include('partials/footer.php');?>