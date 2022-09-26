<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" Placeholder="Title of the Food">
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="30" rows="5" Placeholder="Description of Food"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" min="0" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">

                        <?php 
                            //Create Php code to display categories from database
                            //1. Create SQL to get all active categories from database

                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //Execting Query
                            $res = mysqli_query($conn,$sql);

                            //Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            //If count is greater than zero, we have categories else we donot have categories
                            if($count>0)
                            {
                                //WE have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //Get the details of categories 
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                    <?php
                                }
                            }
                            else
                            {
                                //We do not category
                                ?>
                                <option value="0">NO Categories Found</option>

                                <?php
                            }

                            //2.Display on Dropdown
                        ?>
                     
                       
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>

        </table>



        </form>

        <?php 
        
            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the food in database
                //echo "Clicked";

                //1. Get the data from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check Whether radio buttton for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];

                }
                else
                {
                    $featured = "No"; //Select the default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Select the default value
                }

                //2. Upload the image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check whether the Image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        //Image is selected
                        //A.Rename the image
                        //Get the extension of selected image (jpg,png,gif,etc.)
                        $ext = end(explode('.',$image_name));

                        //Create New name for Image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; //New Image Name

                        //B. Upload the image
                        //Create the source path and destination Path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Pathfor the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finally Upload the Food Image
                        $upload = move_uploaded_file($src,$dst);

                        //Check whether image uploaded or not
                        if($upload==false)
                        {
                            //Failed to upload the image 
                            //Redirect to Add Food Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //Stop the Process
                            die();
                        }


                    }
                }
                else
                {
                    $image_name = ""; //Setting default value is as blank
                }

                //3. Insert into Database

                //Create a Sql Query to save or add food
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the query
                $res = mysqli_query($conn,$sql2);
                //Check whether data inserted or not
                //4. Redirect with message to Manage food Page

                if($res==true)
                {
                    //Data inserted Successfully
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Food Not Added.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>