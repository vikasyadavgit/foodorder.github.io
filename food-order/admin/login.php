<?php include('../config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <br>

        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        
        ?>

        <br><br>

        <!-- Login Form Start Here -->

        <form action="" method="POST" class="text-center">
            <h3>Username:</h3>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            <h3>Password:</h3>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

        </form>

        <!-- Login Form End Here -->

        <p class="text-center">Created By - <a href="#">Vikas Yadav</a></p>
    </div>
</body>
</html>

<?php 

    //Check whether the Submit Button is Clicked or Not
    if(isset($_POST['submit']))
    {
        //Process For Login
        //1. Get the Data from Login Form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn,$sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User Avaiable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div> ";
            $_SESSION['user'] = $username; //To Check Whether the user Logged In or Not and logout will unset it
            //Redirect to Home Page
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User Not Available and Login Failed
            $_SESSION['login'] = "<div class='error'class='text-center'>Username and Password did not Match.</div> ";
            //Redirect to Home Page
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>