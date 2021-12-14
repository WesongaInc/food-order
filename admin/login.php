<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login > Food Ordering and Restaurant Booking System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <?php if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        } ?> <br>
        <!-- Login Form Starts here -->
        <form action="" method="post">
            <table class="midtable">
                <tr>
                    <td>
                    Username :  <br>
                    <input type="text" name="username" placeholder="Enter Username">
                    </td>
                </tr>
                <tr>
                    <td>
                    Password : 
                    <br>
                    <input type="password" name="password" placeholder="Enter Password">
                    </td>
                </tr>
                <tr><td>
                        <input type="submit" name="submit" value="Login" class="btn-primary">
                    </td></tr>
            </table>
             
        </form>
        <!-- Login Form Ends here -->

        <p class="text-center btn-third biddut">Created by <a href="http://www.projects.biddutit.com/resume" target="_blank">Shahriar Ahmed Biddut</a></p>
    </div>
</body>
</html>

<?php
    //Check Whether the submit button clicked
    if(isset($_POST['submit'])){
        // Process for login
        //1.Get the data from Login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        //2.SQL to check whether the user with username and password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
        //3.execute
        $res = mysqli_query($conn,$sql);
        // Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);
        if($count==1){
            //User Available and Login Success
            $_SESSION['login']="<div class='btn-primary text-center'>Login Successful</div>";
        header("location:".SITEURL.'admin/index.php');
        }else{
            //User NOT Available and Login Fail
            $_SESSION['login']="<div class='btn-danger text-center'>Login Failed! Username Password didn't match</div>";
        header("location:".SITEURL.'admin/login.php');

        }




    }
?>