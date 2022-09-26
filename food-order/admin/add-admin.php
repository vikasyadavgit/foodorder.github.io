<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //Checking Whether the Session is Set or Not
            {
                echo $_SESSION['add']; // Display the Session Message if Set
                unset ($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">

             <table class="tbl-30">
                <tr>
                    <td>Full  Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Usename">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

             </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php

//Process the value from Form and save it in Databse.

//Check whether the submit button is clicked or not.

if(isset($_POST['submit']))
{
    //1. Get the Data from Form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);   // Password Encryption with md5.

    //2. SQL query to save the data into databse
    $sql = "INSERT INTO tbl_admin SET
       full_name= '$full_name',
       username= '$username',
       password= '$password'
    ";

    //3. Execute query and save data into database
   
    $res = mysqli_query($conn,$sql) or die(mysqli_error());

    //4. Check the data inserted or not and display appropriate message
    if($res==TRUE)
    {
        //Data Inseted
        //echo "Data Inserted";
        //Create a session Variable to display Message
        $_SESSION['add'] = "Admin Added Successfully";
        //Redirect Page TO Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to insert Data
        //echo "Failed to Insert Data";
          //Create a session Variable to display Message
          $_SESSION['add'] = "Failed To Add Admin";
          //Redirect Page TO Add Admin
          header("location:".SITEURL.'admin/add-admin.php');
    }


}

?>