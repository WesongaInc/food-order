<?php include('partials/menu.php'); ?>
<?php include('partials/required.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1> <br><br>


        <?php 
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
         ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password : </td>
                    <td><input type="password" name="current_password" placeholder="Current Password" required></td>
                </tr>
                <tr>
                <td>New Password : </td>
                    <td><input type="password" name="new_password" placeholder="New Password" required></td>
                </tr>
                <td>Confirm Password : </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php 
    //Check Whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Clicked";

        //1. Get the data from Form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        //2. Check whether the current ID and Current Password Exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //Execute the query 
        $res = mysqli_query($conn,$sql);
        if($res==true)
        {
            //Check whether data is available or not
            $count = mysqli_num_rows($res);
            if($count==1){
                // User Exists and Password can be change
                //echo "User Found";
                //3. Check whether the new password anad Confirm Password match or not
                if($new_password==$confirm_password){
                    //Update password
                    //echo "Password match";
                    $sql2 = "UPDATE tbl_admin SET 
                    password='$new_password'
                    WHERE id=$id";
                    //Execute the query 
                $res2 = mysqli_query($conn,$sql2);
                //Check whether the query executed or not
                if($res2==true){
                    // Display Success
                $_SESSION['user-not-found'] = "<div class='btn-primary'> Password Changed Successfully!</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
                }else{
                    //Display error
                    $_SESSION['user-not-found'] = "<div class='btn-danger'> Password didn't Changed!</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
                }

                }
                else{
                    //Password didn't Match
                $_SESSION['user-not-found'] = "<div class='btn-danger'> Password didn't Match!</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }else{
                //User Doesn't Exists
                $_SESSION['user-not-found'] = "<div class='btn-danger'> User Not Found</div>";
                //Redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }
        
        //4. Change password if all above is true

    }
?>


<?php include('partials/footer.php'); ?>
